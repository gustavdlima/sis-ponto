<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Falta;
use App\Models\Registro;
use DateTime;
use App\Repositories\FaltaRepository;
use App\Services\FaltaService;
use App\Http\Requests\FaltaRequest;

date_default_timezone_set('America/Sao_Paulo');

class FaltaController extends Controller
{
    protected $faltaService;

    public function __construct(FaltaService $faltaService)
    {
        $this->faltaService = $faltaService;
    }

    public function index()
    {
        return $this->faltaService->listarFaltas();
    }

    public function store(FaltaRequest $request)
    {
        return $this->faltaService->criarFalta($request->all());
    }

    public function show($id)
    {
        return $this->faltaService->procurarFaltaPeloId($id);
    }

    public function update(Request $request, $id)
    {
        return $this->faltaService->atualizarFalta($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->faltaService->excluirFalta($id);
    }

    public function faltasFuncionario($id)
    {
        return $this->faltaService->faltasFuncionario($id);
    }

    public function retornaAFaltaDoDiaDoFuncionario($funcionario, $data)
    {
        return $this->faltaService->retornaAFaltaDoDiaDoFuncionario($funcionario, $data);
    }

    public function cadastraFaltaNoRegistro($id_funcionario, $data)
    {
        return $this->faltaService->cadastraFaltaNoRegistro($id_funcionario, $data);
    }

}
