<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegistroService;
use App\Services\FuncionarioService;

class RegistroController extends Controller
{
    protected $registroService;
    protected $funcionarioService;


    public function __construct(RegistroService $registroService, FuncionarioService $funcionarioService)
    {
        $this->registroService = $registroService;
        $this->funcionarioService = $funcionarioService;
    }

    public function index()
    {
        return $this->registroService->listarRegistros();
    }

    public function store(Request $request)
    {
        return $this->registroService->criarRegistro($request->all());
    }

    public function show($id)
    {
        return $this->registroService->procurarRegistroPeloId($id);
    }

    public function update(Request $request, $id)
    {
        return $this->registroService->atualizarRegistro($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->registroService->excluirRegistro($id);
    }

    public function retornaTodoORegistroDoFuncionario(Request $request)
    {
       $funcionario = $this->funcionarioService->procurarFuncionarioPeloId($request->id_funcionario);
        return $this->registroService->retornaTodoORegistroDoFuncionario($funcionario);
    }

    public function retornaOUltimoRegistroDoFuncionario(Request $request)
    {
        return $this->registroService->retornaOUltimoRegistroDoFuncionario($request);
    }

    public function retornaORegistroDaDataEspecificada($funcionario, $data)
    {
        return $this->registroService->retornaORegistroDaDataEspecificada($funcionario, $data);
    }

    public function inserirJustificativaNoRegistro($relatorio)
    {
        return $this->registroService->inserirJustificativaNoRegistro($relatorio);
    }

}
