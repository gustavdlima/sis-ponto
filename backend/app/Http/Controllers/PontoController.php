<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Registro;
use App\Models\Horario;
use App\Models\DiasDaSemana;
use Exception;
use DateTime;
use Psr\Log\NullLogger;

date_default_timezone_set('America/Sao_Paulo');

class PontoController extends Controller
{
    public function verificarPontoSemRegistro($horaAtual, $horaPonto)
    {
        // verifica se a hora atual tem uma diferença acima de 30 minutos do horário do ponto
        $horaAtual = new DateTime($horaAtual);
        $horaPonto = new DateTime($horaPonto);

        $diferenca = strtotime($horaAtual->format('H:i:s')) - strtotime($horaPonto->format('H:i:s'));

        if ($diferenca > 1800)
            return true;
        return false;
    }

    public function padronizarRegistroDoDia($registro, $funcionario)
    {
        // se o usuário estiver atrasado, adicionar atraso ao registro
        if ($registro->atrasou_primeiro_ponto == true)
            $registro->primeiro_ponto = "Atrasado";
        if ($registro->atrasou_segundo_ponto == true)
            $registro->segundo_ponto = "Atrasado";
        if ($registro->atrasou_terceiro_ponto == true)
            $registro->terceiro_ponto = "Atrasado";
        if ($registro->atrasou_quarto_ponto == true)
            $registro->quarto_ponto = "Atrasado";

        return $registro;
    }

    public function retornaRegistroDoDia(Request $request)
    {
        $registro = new RegistroController();

        // procura o funcionario a partir da matricula
        $funcionario = Funcionario::where('matricula', $request->matricula)->first();

        if ($funcionario == null)
            return response()->json([
                'message' => 'Funcionário não encontrado',
                'status' => 404
            ], 404);

        $registro = $registro->retornaOUltimoRegistroDoFuncionario($funcionario);

        $registro = $this->padronizarRegistroDoDia($registro, $funcionario);

        return $registro;
    }

    public function adicionarSemRegistroNoPonto($registro, $indice)
    {
        switch ($indice) {
            case 0:
                $registro->primeiro_ponto = "Sem Registro";
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'primeiro_ponto' => "Sem Registro",
                    ]);
                return $registro;
            case 1:
                $registro->segundo_ponto = "Sem Registro";
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'segundo_ponto' => "Sem Registro",
                    ]);
                return $registro;
            case 2:
                $registro->terceiro_ponto = "Sem Registro";
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'terceiro_ponto' => "Sem Registro",
                    ]);
                return $registro;
            case 3:
                $registro->quarto_ponto = "Sem Registro";
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'quarto_ponto' => "Sem Registro",
                    ]);
                return $registro;
            default:
                return;
        }
    }

    // Adiciona a hora no ponto
    public function adicionarHoraNoPonto($registro, $indice, $horaAtual, $horarioPonto)
    {
        switch ($indice) {
            case 0:
                if ($this->verificarPontoSemRegistro($horaAtual, $horarioPonto) == true)
                    return $this->adicionarSemRegistroNoPonto($registro, $indice);
                $registro->primeiro_ponto = $horaAtual;
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'primeiro_ponto' => $horaAtual,
                    ]);
                return $registro;
            case 1:
                if ($this->verificarPontoSemRegistro($horaAtual, $horarioPonto) == true)
                    return $this->adicionarSemRegistroNoPonto($registro, $indice);
                $registro->segundo_ponto = $horaAtual;
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'segundo_ponto' => $horaAtual,
                    ]);
                return $registro;
            case 2:
                if ($this->verificarPontoSemRegistro($horaAtual, $horarioPonto) == true)
                    return $this->adicionarSemRegistroNoPonto($registro, $indice);
                $registro->terceiro_ponto = $horaAtual;
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'terceiro_ponto' => $horaAtual,
                    ]);
                return $registro;
            case 3:
                if ($this->verificarPontoSemRegistro($horaAtual, $horarioPonto) == true)
                    return $this->adicionarSemRegistroNoPonto($registro, $indice);
                $registro->quarto_ponto = $horaAtual;
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'quarto_ponto' => $horaAtual,
                    ]);
                return $registro;
            default:
                return;
        }
    }

    // checa se o funcionario esta 1 hora ou menos de uma hora adiantado
    public function checaSeOFuncionarioEsta1HoraAdiantado($horarioPonto, $horaAtual)
    {
        // checa se o funcionário está 1 hora ou menos adiantado
        $horarioPonto = new DateTime($horarioPonto);
        $horaAtual = new DateTime($horaAtual);

        $horarioPonto->modify('-1 hour');

        if ($horaAtual < $horarioPonto)
            return true;
        return false;
    }

    public function checaSeOFuncionarioEstaAdiantado($horarioPonto, $horaAtual)
    {
        // checa se o funcionário está mais de 30 minutos adiantado ou 30 minutos adiantado
        $horarioPonto = new DateTime($horarioPonto);
        $horaAtual = new DateTime($horaAtual);

        $horarioPonto->modify('-30 minutes');

        if ($horaAtual < $horarioPonto)
            return true;
        return false;
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
                else if ($i == 3 && $this->checaSeOFuncionarioEsta1HoraAdiantado($horarioPonto, $horaAtual))
                    return $registro;

                // verificar se o funcionario está tentando bater o ponto depois de 30minutos do horário



                $registro = $this->adicionarHoraNoPonto($registro, $i, $horaAtual, $horarioPonto);
            }
        }
        return $registro;
    }

    public function adicionarAtrasoAoRegistro($registro, $indice)
    {
        switch ($indice) {
            case 0:
                $registro->atrasou_primeiro_ponto = true;
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'atrasou_primeiro_ponto' => true,
                    ]);
                return $registro;
            case 1:
                $registro->atrasou_segundo_ponto = true;
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'atrasou_segundo_ponto' => true,
                    ]);
                return $registro;
            case 2:
                $registro->atrasou_terceiro_ponto = true;
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'atrasou_terceiro_ponto' => true,
                    ]);
                return $registro;
            case 3:
                $registro->atrasou_quarto_ponto = true;
                Db::table('registros')
                    ->where('id', $registro->id)
                    ->update([
                        'atrasou_quarto_ponto' => true,
                    ]);
                return $registro;
            default:
                return;
        }
    }

    public function transformarRegistroEmArrayDePontos($registro)
    {
        $pontos = array();
        $pontos[0] = $registro->primeiro_ponto;
        $pontos[1] = $registro->segundo_ponto;
        $pontos[2] = $registro->terceiro_ponto;
        $pontos[3] = $registro->quarto_ponto;
        return $pontos;
    }

    public function retornaHorarioEmFormatoDeArray($horarioId)
    {
        $horarios = Horario::where('id', $horarioId)->get();

        if ($horarios == null)
            return null;

        $horarioArray = array();
        $horarioArray[0] = $horarios[0]->primeiro_horario;
        $horarioArray[1] = $horarios[0]->segundo_horario;
        if ($horarios[0]->terceiro_horario != null)
            $horarioArray[2] = $horarios[0]->terceiro_horario;
        if ($horarios[0]->quarto_horario != null)
            $horarioArray[3] = $horarios[0]->quarto_horario;
        return $horarioArray;
    }

    public function retornaTabelaDoDiaDaSemana($funcionario)
    {
        $tabelaDiasDaSemana = DiasDaSemana::where('id', $funcionario->id_dia_da_semana)->get();
        if ($tabelaDiasDaSemana == null || count($tabelaDiasDaSemana) == 0)
            return null;
        return $tabelaDiasDaSemana;
    }


    public function checaSeOFuncionarioEstaAtrasado($funcionario, $registro, $diaAtual, $horaAtual)
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
                    $registro = $this->adicionarAtrasoAoRegistro($registro, $i);
            }
        }

        return $registro;
    }

    public function retornaOHorarioDoFuncionarioNoDiaAtual($funcionario, $diaAtual)
    {
        $tabelaDiasDaSemana = $this->retornaTabelaDoDiaDaSemana($funcionario);
        if ($tabelaDiasDaSemana == null)
            return null;
        switch ($diaAtual) {
            case 1:
                if ($tabelaDiasDaSemana[0]->segunda == null)
                    return null;
                $horarioId = $tabelaDiasDaSemana[0]->segunda;
                return $this->retornaHorarioEmFormatoDeArray($horarioId);
            case 2:
                if ($tabelaDiasDaSemana[0]->terca == null)
                    return null;
                $horarioId = $tabelaDiasDaSemana[0]->terca;
                return $this->retornaHorarioEmFormatoDeArray($horarioId);
            case 3:
                if ($tabelaDiasDaSemana[0]->quarta == null)
                    return null;
                $horarioId = $tabelaDiasDaSemana[0]->quarta;
                return $this->retornaHorarioEmFormatoDeArray($horarioId);
            case 4:
                if ($tabelaDiasDaSemana[0]->quinta == null)
                    return null;
                $horarioId = $tabelaDiasDaSemana[0]->quinta;
                return $this->retornaHorarioEmFormatoDeArray($horarioId);
            case 5:
                if ($tabelaDiasDaSemana[0]->sexta == null)
                    return null;
                $horarioId = $tabelaDiasDaSemana[0]->sexta;
                return $this->retornaHorarioEmFormatoDeArray($horarioId);
            default:
                $horarioId = null;
                return $horarioId;
        }
    }

    public function checaSeJaBateuTodosOsPontosDoDia($funcionario, $registro, $diaAtual)
    {
        $horario = $this->retornaOHorarioDoFuncionarioNoDiaAtual($funcionario, $diaAtual);

        if ($horario == null)
            throw new Exception('Você não tem horário cadastrado para o dia atual, contate o RH.', 404);

        $quantidadeDeHorarios = count($horario);
        if ($quantidadeDeHorarios == 1) {
            if ($registro->primeiro_ponto != null)
                return true;
            return false;
        }
        if ($quantidadeDeHorarios == 2) {
            if ($registro->primeiro_ponto != null && $registro->segundo_ponto != null)
                return true;
            return false;
        }
        if ($quantidadeDeHorarios == 3) {
            if ($registro->primeiro_ponto != null && $registro->segundo_ponto != null && $registro->terceiro_ponto != null)
                return true;
            return false;
        }
        if ($quantidadeDeHorarios == 4) {
            if ($registro->primeiro_ponto != null && $registro->segundo_ponto != null && $registro->terceiro_ponto != null && $registro->quarto_ponto != null)
                return true;
            return false;
        }
        return false;
    }

    public function checaSeORegistroFoiCriadoNoMesmoDia($registro)
    {
        $date = date('Y-m-d');
        $createdAt = $registro->created_at;
        $split = explode('T', $createdAt);
        $split = explode(' ', $createdAt);
        $createdAt = $split[0];
        $date2 = date('Y-m-d', strtotime($createdAt));
        if ($date == $date2)
            return true;
        return false;
    }

    public function criarRegistro($funcionario)
    {
        if ($this->validarFuncionario($funcionario) == false)
            return null;
        $registroArray = array(
            'id_funcionario' => $funcionario->id,
            'id_horario' => $funcionario->id_horario,
            'primeiro_ponto' => null,
            'segundo_ponto' => null,
            'terceiro_ponto' => null,
            'quarto_ponto' => null,
            'atrasou_primeiro_ponto' => false,
            'atrasou_segundo_ponto' => false,
            'atrasou_terceiro_ponto' => false,
            'atrasou_quarto_ponto' => false
        );
        $registro = new Registro($registroArray);
        $registro->save();
        return $registro;
    }

    public function retornaUltimoRegistroDoFuncionario($funcionarioId)
    {
        if ($funcionarioId == null)
            return null;
        $registro = Registro::where('id_funcionario', $funcionarioId)->latest()->get()->first();

        if ($registro && $this->checaSeORegistroFoiCriadoNoMesmoDia($registro) == true)
            return $registro;

        return null;
    }

    public function checaSeOFuncionarioTemRegistro($funcionario)
    {
        $registro = $this->retornaUltimoRegistroDoFuncionario($funcionario->id);
        if (!$registro) {
            $registro = $this->criarRegistro($funcionario);
            return $registro;
        }
        return $registro;
    }

    public function validarFuncionario($funcionario): bool
    {
        if ($funcionario == null)
            return false;
        if ($funcionario->id == null || $funcionario->id < 1)
            return false;
        return true;
    }

    public function checaSeOFuncionarioExiste(Request $request): ?Funcionario
    {
        $funcionario = Funcionario::firstOrNew(['matricula' => $request->matricula]);

        if ($funcionario->id != null)
            return $funcionario;
        return null;
    }

    public function adicionarDataAoRegistro($registro)
    {
        Db::table('registros')
            ->where('id', $registro->id)
            ->update([
                'data' => date('d/m/Y'),
            ]);
        return $registro;
    }

    public function registrarPonto(Request $request)
    {
        try {
            // Pega a hora atual e o dia atual
            $horaAtual = date('H:i:s');
            $diaAtual = date('w');

            // Valida o funcionário
            $funcionario = $this->checaSeOFuncionarioExiste($request);
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

            return $registro;

            if ($registro->data == null)
                $registro = $this->adicionarDataAoRegistro($registro);

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
}
