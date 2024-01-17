<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Registro;


class LoginController extends Controller
{

    public function check(Request $request)
    {
        // checa se o funcionário existe
        $funcionario = Db::select('select * from funcionarios where matricula = ? ', [$request->matricula]);

        if ($funcionario != null)
        return $funcionario;
    return 0;
    }

    public function criarTabelaRegistro(Request $request)
    {

        // checar se o funcionário existe
        $funcionario = $this->check($request);

        if ($funcionario == 0)
            return response()->json(["message" => "Funcionário não encontrado"]);

        // LEMBRE DE DESCOMENTAR
        if ($funcionario[0]->nivel == 3) {
            $registro = new RegistroController();
            $registro = $registro->store($funcionario);
            return response()->json([
                'registro' => $registro
            ]);
        }

        return ;
    }
}
