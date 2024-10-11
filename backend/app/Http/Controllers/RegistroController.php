<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegistroService;
use App\Services\FuncionarioService;
use App\Repositories\RegistroRepository;

class RegistroController extends Controller
{
    protected $registroService;
    protected $funcionarioService;


    public function __construct(RegistroService $registroService, FuncionarioService $funcionarioService, RegistroRepository $registroRepository)
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

    public function criarEstruturaDeRegistro($funcionario)
    {
        return $this->registroService->criarEstruturaDeRegistro($funcionario);
    }

    public function retornaUltimoRegistroDoFuncionario(Request $request)
    {
        return $this->registroService->retornaUltimoRegistroDoFuncionario($request->id);
    }

    public function retornaTodoORegistroComJustificativa(Request $request)
    {
        return $this->registroService->retornaTodoORegistroComJustificativa($request->id_funcionario);
    }

    public function adicionarAtrasoAoRegistro($registro, $index)
    {
        return $this->registroService->adicionarAtrasoAoRegistro($registro, $index);
    }

    public function adicionarSemRegistroNoPontoDoRegistro($registro, $index)
    {
        return $this->registroService->adicionarSemRegistroNoPontoDoRegistro($registro, $index);
    }

    public function retornaORegistroDoDia(Request $request)
    {
        return $this->registroService->retornaORegistroDoDia($request->matricula);
    }
}
