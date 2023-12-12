<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Registro;


class LoginController extends Controller
{
    public function register($funcionario) {
        $registro = new Registro();
        $date = date('Y-m-d H:i:s');

        $registroJson = array('id_funcionario' => $funcionario[0]->id,
            'primeiro_ponto' => $date,
            'segundo_ponto' => null,
            'terceiro_ponto' => null,
            'quarto_ponto' => null,
        );

        $registroId = $registro->create($registroJson);

        return $registroJson;
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
