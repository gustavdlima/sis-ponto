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
        $funcionario = Funcionario::firstOrNew(['matricula' => $request->matricula]);

        if ($funcionario->id != null)
            return $funcionario;
        return null;
    }

    public function criarTabelaRegistro(Request $request)
    {
        // checar se o funcionário existe
        $funcionario = $this->check($request);

        if (!$funcionario)
           return response()->json(['message' => 'Funcionário não encontrado',
            'status' => 404], 404);

        // criar registro de ponto e registrar o primeiro ponto
        $registro = new RegistroController();
        return $registro->store($funcionario);
    }
}
