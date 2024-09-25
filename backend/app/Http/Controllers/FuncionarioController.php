<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\FuncionarioService;
use App\Http\Requests\FuncionarioRequest;


class FuncionarioController extends Controller
{
    protected $funcionarioService;

    public function __construct(FuncionarioService $funcionarioService)
    {
        $this->funcionarioService = $funcionarioService;
    }

    public function index()
    {
        return $this->funcionarioService->listarFuncionarios();
    }

    public function store(FuncionarioRequest $request)
    {
        return $this->funcionarioService->criarFuncionario($request->all());
    }

    public function show($id)
    {
        return $this->funcionarioService->procurarFuncionarioPeloId($id);
    }

    public function update(Request $request, $id)
    {
        return $this->funcionarioService->atualizarFuncionario($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->funcionarioService->excluirFuncionario($id);
    }

}
