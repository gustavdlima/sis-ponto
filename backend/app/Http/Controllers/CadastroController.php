<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HorarioController;
use Illuminate\Support\Facades\Auth;
use Hash;


class CadastroController extends Controller
{
    public function store(Request $request)
    {
        $funcionario = new FuncionarioController();
        $funcionario = $funcionario->store($request);

        return response()->json(['message' => 'Funcionário criado com sucesso!', 'funcionarioId' => $funcionario]);
    }
}
