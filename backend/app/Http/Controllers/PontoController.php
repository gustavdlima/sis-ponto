<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Registro;
use App\Models\Horario;
use App\Models\DiasDaSemana;
use DateTime;
use DateInterval;

date_default_timezone_set('America/Sao_Paulo');

class PontoController extends Controller
{
    public function adicionarAtrasoAoRegistro($registro, $indice) {
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

    public function transformarRegistroEmArrayDePontos($registro) {
        $pontos = array();
        $pontos[0] = $registro->primeiro_ponto;
        $pontos[1] = $registro->segundo_ponto;
        $pontos[2] = $registro->terceiro_ponto;
        $pontos[3] = $registro->quarto_ponto;
        return $pontos;
    }

    public function retornaHorarioEmFormatoDeArray($horarioId, $funcionario)
    {
        $horarios = Horario::where('id', $horarioId)->get();

        if ($horarios == null)
            return null;

        $horarioArray = array();
        if ($funcionario->carga_horaria == "20h") {
            $horarioArray[0] = $horarios[0]->primeiro_horario;
            $horarioArray[1] = $horarios[0]->segundo_horario;
        } else if ($funcionario->carga_horaria == "40h") {
            $horarioArray[0] = $horarios[0]->primeiro_horario;
            $horarioArray[1] = $horarios[0]->segundo_horario;
            $horarioArray[2] = $horarios[0]->terceiro_horario;
            $horarioArray[3] = $horarios[0]->quarto_horario;
        }
        return $horarioArray;
    }

    public function retornaOHorarioDoFuncionarioNoDiaAtual($funcionario, $diaAtual)
    {
        $tabelaDiasDaSemana = $this->retornaTabelaDoDiaDaSemana($funcionario);
        if ($tabelaDiasDaSemana == null)
            return "null";
        switch ($diaAtual) {
            case 1:
                $horarioId = $tabelaDiasDaSemana[0]->segunda;
                return $this->retornaHorarioEmFormatoDeArray($horarioId, $funcionario);
            case 2:
                $horarioId = $tabelaDiasDaSemana[0]->terca;
                return $this->retornaHorarioEmFormatoDeArray($horarioId, $funcionario);
            case 3:
                $horarioId = $tabelaDiasDaSemana[0]->quarta;
                return $this->retornaHorarioEmFormatoDeArray($horarioId, $funcionario);
            case 4:
                $horarioId = $tabelaDiasDaSemana[0]->quinta;
                return $this->retornaHorarioEmFormatoDeArray($horarioId, $funcionario);
            case 5:
                $horarioId = $tabelaDiasDaSemana[0]->sexta;
                return $this->retornaHorarioEmFormatoDeArray($horarioId, $funcionario);
            default:
                $horarioId = null;
                return $horarioId;
        }
    }

    public function retornaTabelaDoDiaDaSemana($funcionario)
    {
        $tabelaDiasDaSemana = DiasDaSemana::where('id', $funcionario->id_dia_da_semana)->get();
        if ($tabelaDiasDaSemana == null)
            return null;
        return $tabelaDiasDaSemana;
    }

    public function checaSeOFuncionarioEstaAtrasado($funcionario, $registro, $diaAtual, $horaAtual)
    {
        // Pegar os horarios do dia do funcionario em forma de array
        $arrayHorarioDiaAtual = $this->retornaOHorarioDoFuncionarioNoDiaAtual($funcionario, $diaAtual);

        // Colocar os pontos do registros em array
        $arrayPontos = $this->transformarRegistroEmArrayDePontos($registro);

        // Loop para identificar os atrasos dos pontos não preenchidos e salvar no db
        for($i = 0; $i < count($arrayHorarioDiaAtual); $i++) {
            if ($arrayHorarioDiaAtual[$i] == null)
                continue;
            if ($arrayPontos[$i] == null) {
                $diferenca = strtotime($horaAtual) - strtotime($arrayHorarioDiaAtual[$i]);

                // se a diferença for maior que 15 minutos, o funcionário está atrasado
                if ($diferenca > 900)
                    $registro = $this->adicionarAtrasoAoRegistro($registro, $i);
            }
        }

        return $registro;
    }

    public function checaSeJaBateuTodosOsPontosDoDia($funcionario, $registro): bool
    {
        if ($funcionario->carga_horaria == "20h") {
            if ($registro->primeiro_ponto != null && $registro->segundo_ponto != null)
                return true;
            return false;
        } else if ($funcionario->carga_horaria == "40h") {
            if ($registro->primeiro_ponto != null && $registro->segundo_ponto != null && $registro->terceiro_ponto != null && $registro->quarto_ponto != null)
                return true;
            return false;
        }
        return false;
    }

    public function checaSeORegistroFoiCriadoNoMesmoDia($registro): bool
    {
        $date = date('Y-m-d');
        $createdAt = $registro->created_at;
        $rest = strpos($createdAt, $date);
        if ($rest !== false) {
            $split = explode('T', $createdAt);
            $split = explode(' ', $createdAt);
            $createdAt = $split[0];
            if ($createdAt == $date) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function criarRegistro($funcionario): ?Registro
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

    public function retornaUltimoRegistroDoFuncionario($funcionarioId): ?Registro
    {
        if ($funcionarioId == null)
            return null;
        $registro = Registro::where('id_funcionario', $funcionarioId)->latest()->get()->first();

        if (!$this->checaSeORegistroFoiCriadoNoMesmoDia($registro))
            return null;

        return $registro ?? null;
    }

    public function checaSeOFuncionarioTemRegistroESeBateuTodosOsPontos($funcionario)
    {
        $registro = $this->retornaUltimoRegistroDoFuncionario($funcionario->id);
        if (!$registro) {
            $registro = $this->criarRegistro($funcionario);
            return $registro;
        }
        if ($this->checaSeJaBateuTodosOsPontosDoDia($funcionario, $registro))
            return response()->json([
                'message' => 'Funcionário já bateu todos os pontos do dia',
                'status' => 400,
                'registro' => $registro,
                'pontosBatidos' => true,
            ], 400);
        return $registro;
    }

    public function validarFuncionario($funcionario): bool
    {
        if ($funcionario == null)
            return false;
        if ($funcionario->id_horario == null || $funcionario->id_horario == 0)
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

    public function registrarPonto(Request $request)
    {
        $horaAtual = date('H:i:s');
        $diaAtual = date('w');

        // Checa e valida o funcionário
        $funcionario = $this->checaSeOFuncionarioExiste($request);
        if (!$funcionario)
            return response()->json([
                'message' => 'Funcionário não encontrado',
                'status' => 404
            ], 404);

        // Certifica se o funcionário já tem registro no dia e se bateu todos os pontos
        $registro = $this->checaSeOFuncionarioTemRegistroESeBateuTodosOsPontos($funcionario);

        // Se o funcionário já bateu todos os pontos do dia, retorna o registro
        if ($registro->pontosBatidos)
            return $registro;

        // Checa se o funcionário tem pontos em atraso
        $registro = $this->checaSeOFuncionarioEstaAtrasado($funcionario, $registro, $diaAtual, $horaAtual);

        return $registro;
        // Registra o ponto
        return response()->json([
            'message' => 'Registro criado com sucesso',
            'status' => 201
        ], 201);
    }

    // public function criarTabelaRegistro(Request $request) {
    //     $funcionario = $this->checaSeOFuncionarioExiste($request);

    //     if (!$funcionario)
    //        return response()->json(['message' => 'Funcionário não encontrado',
    //         'status' => 404], 404);


    //     // criar registro de ponto e registrar o primeiro ponto
    //     $registro = new RegistroController();
    //     return $registro->store($funcionario);
    // }
}
