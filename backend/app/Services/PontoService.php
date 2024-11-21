<?php

namespace App\Services;

use App\Services\RegistroService;
use App\Services\FuncionarioService;
use App\Services\DiasDaSemanaService;
use App\Services\HorarioService;
use Illuminate\Http\Request;
use DateTime;

use Exception;

class PontoService
{
	protected $registroService;
	protected $funcionarioService;
	protected $DiasDaSemanaService;
	protected $HorarioService;

	public function __construct(RegistroService $registroService,
	FuncionarioService $funcionarioService, DiasDaSemanaService $DiasDaSemanaService, HorarioService $HorarioService)
	{
		$this->registroService = $registroService;
		$this->funcionarioService = $funcionarioService;
		$this->DiasDaSemanaService = $DiasDaSemanaService;
		$this->HorarioService = $HorarioService;
	}

	public function registrarPonto(Request $request)
    {
        try {
            // Pega a hora atual e o dia atual
            $horaAtual = date('H:i:s');
            // $horaAtual = "08:30:00";
            $diaAtual = date('w');

            // Valida o funcionário
            $funcionario = $this->funcionarioService->procurarFuncionarioPelaMatricula($request->matricula);

            if (!$funcionario)
                throw new Exception('Funcionário não encontrado', 404);

            // Certifica se o funcionário já tem registro no dia e se bateu todos os pontos, se não tiver, cria um registro novo
            $registro = $this->checaSeOFuncionarioTemRegistro($funcionario);

            // Se o funcionário já bateu todos os pontos do dia, retorna o registro
            if ($this->checaSeJaBateuTodosOsPontosDoDia($funcionario, $registro, $diaAtual)) {
				return response()->json([
					'message' => 'O funcionário já bateu todos os pontos do dia',
                    'status' => 200,
                ], 200);
            }

            // Checa se o funcionário tem pontos em atraso
            $registro = $this->checaSeOFuncionarioEstaAtrasado($funcionario, $registro, $diaAtual, $horaAtual);

            // Registra a hora no ponto
            $registro = $this->registrarHoraNoPonto($registro, $funcionario, $diaAtual, $horaAtual);

            return response()->json([
                'message' => 'Registro criado com sucesso',
                'status' => 201,
                'registro' => $registro
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

	private function checaSeOFuncionarioTemRegistro($funcionario)
    {
		$registro = $this->registroService->retornaUltimoRegistroDoFuncionario($funcionario->id);

        if (!$registro || !$this->checaSeORegistroFoiCriadoNoDiaAtual($registro->created_at)) {
            return $this->registroService->criarEstruturaDeRegistro($funcionario);
        }

        return $registro;
    }

    private function checaSeORegistroFoiCriadoNoDiaAtual($dataRegistro)
    {
        $dataRegistroFormatada = date('Y-m-d', strtotime($dataRegistro));
        $dataAtual = date('Y-m-d');
        return $dataRegistroFormatada === $dataAtual;
    }

	private function checaSeJaBateuTodosOsPontosDoDia($funcionario, $registro, $diaAtual)
    {
        $horario = $this->retornaOHorarioDoFuncionarioNoDiaAtual($funcionario, $diaAtual);

        if ($horario === null) {
            throw new Exception('Você não tem horário cadastrado para o dia atual, contate o RH.', 404);
        }

        $quantidadeDeHorarios = count($horario);

        $pontos = [
            $registro->primeiro_ponto,
            $registro->segundo_ponto,
            $registro->terceiro_ponto,
            $registro->quarto_ponto,
        ];

        for ($i = 0; $i < $quantidadeDeHorarios; $i++) {
            if ($pontos[$i] === null) {
                return false;
            }
        }

        return true;
    }

	private function retornaOHorarioDoFuncionarioNoDiaAtual($funcionario, $diaAtual)
    {
		$tabelaDiasDaSemana = $this->DiasDaSemanaService->retornaTabelaDoDiaDaSemanaDoFuncionario($funcionario);

        if ($tabelaDiasDaSemana == null || !isset($tabelaDiasDaSemana[0])) {
			throw new Exception('Você não tem horário definido, contate o RH', 404);
		}

        switch ($diaAtual) {
            case 1:
                if ($tabelaDiasDaSemana[0]->segunda == null) {
					throw new Exception('Horário não encontrado para segunda-feira.', 404);
				}
                $horarioId = $tabelaDiasDaSemana[0]->segunda;
                return $this->HorarioService->retornaHorarioEmFormatoDeArray($horarioId);
            case 2:
                if ($tabelaDiasDaSemana[0]->terca == null)
                    throw new Exception('Horário não encontrado para terça-feira.', 404);
				$horarioId = $tabelaDiasDaSemana[0]->terca;
                return $this->HorarioService->retornaHorarioEmFormatoDeArray($horarioId);
				case 3:
					if ($tabelaDiasDaSemana[0]->quarta == null)
                    throw new Exception('Horário não encontrado para quarta-feira.', 404);
				$horarioId = $tabelaDiasDaSemana[0]->quarta;
                return $this->HorarioService->retornaHorarioEmFormatoDeArray($horarioId);
				case 4:
					if ($tabelaDiasDaSemana[0]->quinta == null)
                    throw new Exception('Horário não encontrado para quinta-feira.', 404);
				$horarioId = $tabelaDiasDaSemana[0]->quinta;
                return $this->HorarioService->retornaHorarioEmFormatoDeArray($horarioId);
				case 5:
					if ($tabelaDiasDaSemana[0]->sexta == null)
                    throw new Exception('Horário não encontrado para sexta-feira.', 404);
				$horarioId = $tabelaDiasDaSemana[0]->sexta;
                return $this->HorarioService->retornaHorarioEmFormatoDeArray($horarioId);
            default:
                $horarioId = null;
                return $horarioId;
        }
    }

	private function checaSeOFuncionarioEstaAtrasado($funcionario, $registro, $diaAtual, $horaAtual)
    {
        // Pegar os horarios do dia do funcionario em forma de array
        $horariosDiaAtual  = $this->retornaOHorarioDoFuncionarioNoDiaAtual($funcionario, $diaAtual);

        if ($horariosDiaAtual == null)
            throw new Exception('Horário Semanal do funcionário não encontrado', 404);

        // Colocar os pontos do registros em array
        $pontosRegistro = $this->transformarRegistroEmArrayDePontos($registro);

        // Loop para identificar os atrasos dos pontos não preenchidos e salvar no db
        for ($i = 0; $i < count($horariosDiaAtual); $i++) {
            $horarioPonto = $horariosDiaAtual[$i];
            $pontoRegistro = $pontosRegistro[$i];

            if ($horarioPonto == null)
                continue;
            if ($pontoRegistro == null) {
                $diferenca = strtotime($horaAtual) - strtotime($horarioPonto);

                // se a diferença for maior que 30 minutos, o funcionário está atrasado
                if ($diferenca > 1800)
                    $registro = $this->registroService->adicionarAtrasoAoRegistro($registro, $i);
            }
        }

        return $registro;
    }

	private function transformarRegistroEmArrayDePontos($registro)
    {
        $pontos = array();
        $pontos[0] = $registro->primeiro_ponto;
        $pontos[1] = $registro->segundo_ponto;
        $pontos[2] = $registro->terceiro_ponto;
        $pontos[3] = $registro->quarto_ponto;
        return $pontos;
    }

	public function registrarHoraNoPonto($registro, $funcionario, $diaAtual, $horaAtual)
    {
        $horariosDiaAtual = $this->retornaOHorarioDoFuncionarioNoDiaAtual($funcionario, $diaAtual);
        $pontosRegistro = $this->transformarRegistroEmArrayDePontos($registro);

        for ($i = 0; $i < count($horariosDiaAtual); $i++) {
            $horarioPonto = $horariosDiaAtual[$i];
            $pontoRegistro = $pontosRegistro[$i];

            if ($pontoRegistro == null) {
                if ($i <= 2 && $this->checaSeOFuncionarioEstaAdiantado($horarioPonto, $horaAtual) == true)
                    return $registro;
                else if ($i == 3 && $this->checaSeOFuncionarioEsta2HorasAdiantado($horarioPonto, $horaAtual))
                    return $registro;

                $registro = $this->adicionarHoraNoPonto($registro, $i, $horaAtual, $horarioPonto);
            }
        }
        return $registro;
    }

	private function checaSeOFuncionarioEsta2HorasAdiantado($horarioPonto, $horaAtual)
    {
        // checa se o funcionário está 1 hora ou menos adiantado
        $horarioPonto = new DateTime($horarioPonto);
        $horaAtual = new DateTime($horaAtual);

        $horarioPonto->modify('-2 hour');

        if ($horaAtual < $horarioPonto)
            return true;
        return false;
    }

	private function checaSeOFuncionarioEstaAdiantado($horarioPonto, $horaAtual)
    {
        // checa se o funcionário está mais de 30 minutos adiantado ou 30 minutos adiantado
        $horarioPonto = new DateTime($horarioPonto);
        $horaAtual = new DateTime($horaAtual);

        $horarioPonto->modify('-30 minutes');

        if ($horaAtual < $horarioPonto)
            return true;
        return false;
    }

	private function adicionarHoraNoPonto($registro, $indice, $horaAtual, $horarioPonto)
    {
        switch ($indice) {
            case 0:
                if ($this->verificarPontoSemRegistro($horaAtual, $horarioPonto) == true ){
                    return $this->registroService->adicionarSemRegistroNoPontoDoRegistro($registro, $indice);
				}
                $registro->primeiro_ponto = $horaAtual;
                return $this->registroService->atualizarRegistro([
					'primeiro_ponto' => $horaAtual,
				], $registro->id);
            case 1:
                if ($this->verificarPontoSemRegistro($horaAtual, $horarioPonto) == true) {
                    return $this->registroService->adicionarSemRegistroNoPontoDoRegistro($registro, $indice);
				}
                $registro->segundo_ponto = $horaAtual;
                return $this->registroService->atualizarRegistro([
					'segundo_ponto' => $horaAtual,
				], $registro->id);
            case 2:
                if ($this->verificarPontoSemRegistro($horaAtual, $horarioPonto) == true) {
                    return $this->registroService->adicionarSemRegistroNoPontoDoRegistro($registro, $indice);
				}
                $registro->terceiro_ponto = $horaAtual;
                return $this->registroService->atualizarRegistro([
					'terceiro_ponto' => $horaAtual,
				], $registro->id);
            case 3:
                if ($this->verificarPontoSemRegistro($horaAtual, $horarioPonto) == true) {
                    return $this->registroService->adicionarSemRegistroNoPontoDoRegistro($registro, $indice);
				}
                $registro->quarto_ponto = $horaAtual;
                return $this->registroService->atualizarRegistro([
					'quarto_ponto' => $horaAtual,
				], $registro->id);
            default:
                return;
        }
    }

	private function verificarPontoSemRegistro($horaAtual, $horaPonto)
    {
        // verifica se a hora atual tem uma diferença acima de 30 minutos do horário do ponto
        $horaAtual = new DateTime($horaAtual);
        $horaPonto = new DateTime($horaPonto);

        $diferenca = strtotime($horaAtual->format('H:i:s')) - strtotime($horaPonto->format('H:i:s'));

        if ($diferenca > 1800)
            return true;
        return false;
    }

	public function adicionarDataAoRegistro($registro)
    {
        return $this->registroService->atualizarRegistro([
			'data' => date('d/m/Y'),
		], $registro->id);
    }

}

