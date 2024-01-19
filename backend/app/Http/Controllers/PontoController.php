<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Registro;

class PontoController extends Controller
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
            return "Funcionário não existe";

        // criar registro de ponto e registrar o primeiro ponto
        $registro = new RegistroController();
        return $registro->store($funcionario);
    }
}
