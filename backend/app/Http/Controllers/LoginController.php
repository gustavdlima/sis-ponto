<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Registro;


class LoginController extends Controller
{
    public function register($funcionario) {
        $registro = new RegistroController();
        $date = date('Y-m-d H:i:s');
        $registroArray = $registro->createRegistroArray($funcionario);

        $registroFuncionario = $registro->getLastFuncionarioRegistro($funcionario[0]->id);
        if ($registroFuncionario == null) {
            $registroArray['primeiro_ponto'] = $date;
            $newRegistro = $registro->create($registroArray);
            $newRegistro->save();
            return $newRegistro;
        } else {
            $registro->checkWhichPonto($registroFuncionario, $registroArray);
            return $registroFuncionario;
        }
    }

    public function check(Request $request)
    {
        // search for funcionário
        $funcionario = Db::select('select * from funcionarios where matricula = ? and data_nascimento = ?', [$request->matricula, $request->data_nascimento]);

        if ($funcionario != null) {
            $teste = $this->register($funcionario);
            return $teste;
        } else {
            return response()->json([
                'message' => 'Funcionário não encontrado',
            ]);
        }
    }
}
