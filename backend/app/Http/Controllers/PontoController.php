<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Registro;
use DateTime;
use DateInterval;

date_default_timezone_set('America/Sao_Paulo');

class PontoController extends Controller
{
    public function checaSeOFuncionarioEstaAtrasado($funcionario, $registro)
    {
        // Procurar qual ponto ainda não foi batido para buscar o horário do ponto que o funcionário precisa bater
        //
    }

    public function checaSeJaBateuTodosOsPontosDoDia($funcionario, $registro): bool
    {
        if ($funcionario->carga_horaria == "20h") {
            if ($registro->primeiro_ponto != null && $registro->segundo_ponto != null)
                return true;
            return false;
        }
        else if ($funcionario->carga_horaria == "40h") {
            if ($registro->primeiro_ponto != null && $registro->segundo_ponto != null && $registro->terceiro_ponto != null && $registro->quarto_ponto != null)
                return true;
            return false;
        }
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

    public function checaSeOFuncionarioTemRegistroESeBateuTodosOsPontos($funcionario): ?Registro
    {
        $registro = $this->retornaUltimoRegistroDoFuncionario($funcionario->id);
        if (!$registro) {
            $registro = $this->criarRegistro($funcionario);
            return $registro;
        }
        else {
            if ($this->checaSeJaBateuTodosOsPontosDoDia($funcionario, $registro))
                return response()->json([
                    'message' => 'Funcionário já bateu todos os pontos do dia',
                    'status' => 400,
                    'registro' => $registro,
                    'pontosBatidos' => true,
                ], 400);
        }
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
        if ($registro->pontosBatidos == true)
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
