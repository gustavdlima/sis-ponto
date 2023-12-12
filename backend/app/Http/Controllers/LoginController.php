<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;


class LoginController extends Controller
{
    public function fillRegistro

    public function check(Request $request)
    {
        // search for funcionário
        $funcionario = Db::select('select * from funcionarios where matricula = ? and data_nascimento = ?', [$request->matricula, $request->data_nascimento]);

        if ($funcionario != null) {

            return $funcionario;
        } else {
            return response()->json([
                'message' => 'Funcionário não encontrado',
            ]);
        }
    }
}
