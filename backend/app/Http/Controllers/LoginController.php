<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Registro;


class LoginController extends Controller
{
    public function criarTabelaRegistro($funcionario) {
        // criar registro e registrar o primeiro ponto
        $registro = new RegistroController();
        $date = date('Y-m-d H:i:s');
        $registroArray = $registro->createRegistroArray($funcionario);

        // checar se o funcionário possui registro
        $registroFuncionario = $registro->getLastFuncionarioRegistro($funcionario[0]->id);

        // criar registro de ponto
        if ($registroFuncionario == null) {
            $registroArray['primeiro_ponto'] = $date;
            $newRegistro = $registro->create($registroArray);
            $newRegistro->save();
        } else {
          $registro->checkWhichPonto($registroFuncionario, $registroArray);
        }
    }

    public function check(Request $request)
    {
        // checar se o funcionário existe
        $funcionario = Db::select('select * from funcionarios where matricula = ? ', [$request->matricula]);

        // se existir, criar tabela de registro
        // a função retorna um nível para guardar no frontend(pinia)
        if ($funcionario != null) {
            $this->criarTabelaRegistro($funcionario);
            return $funcionario[0]->nivel;
        } else {
            return response()->json([
                'message' => 'Funcionário não encontrado',
            ]);
        }
    }
}
