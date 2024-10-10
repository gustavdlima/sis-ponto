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
    protected $registroRepository;


    public function __construct(RegistroService $registroService, FuncionarioService $funcionarioService, RegistroRepository $registroRepository)
    {
        $this->registroService = $registroService;
        $this->funcionarioService = $funcionarioService;
        $this->registroRepository = $registroRepository;
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

    public function retornaTodoORegistroComJustificativa(Request $request)
    {
        return $this->registroRepository->retornaTodoORegistroComJustificativa($request->id_funcionario);
    }
}
