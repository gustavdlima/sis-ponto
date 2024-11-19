<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Justificativa;
use App\Http\Requests\JustificativaRequest;
use App\Services\JustificativaService;

class JustificativaController extends Controller
{

    protected $justificativaService;

    public function __construct(JustificativaService $justificativaService)
    {
        $this->justificativaService = $justificativaService;
    }

    public function index()
    {
        return $this->justificativaService->listarJustificativas();
    }

    public function store(JustificativaRequest $request)
    {
        return $this->justificativaService->criarJustificativa($request->all());
    }

    public function show($id)
    {
        return $this->justificativaService->procurarJustificativaPeloId($id);
    }

    public function update(JustificativaRequest $request, $id)
    {
        return $this->justificativaService->atualizarJustificativa($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->justificativaService->excluirJustificativa($id);
    }

    public function justificativaFuncionario($id)
    {
        return Justificativa::where('funcionario_id', $id)->get();
    }

    public function retornaAJustificativaDoDiaDoFuncionario($funcionario, $data)
    {
        return $this->justificativaService->retornaAJustificativaDoDiaDoFuncionario($funcionario, $data);
    }
}
