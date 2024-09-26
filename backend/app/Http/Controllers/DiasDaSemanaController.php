<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiasDaSemanaRequest;
use App\Models\DiasDaSemana;
use App\Services\DiasDaSemanaService;

class DiasDaSemanaController extends Controller
{
    protected $diasDaSemanaService;

    public function __construct(DiasDaSemanaService $diasDaSemanaService)
    {
        $this->diasDaSemanaService = $diasDaSemanaService;
    }

    public function index()
    {
        return $this->diasDaSemanaService->listarDiasDaSemana();
    }

    public function store(DiasDaSemanaRequest $request)
    {
        return $this->diasDaSemanaService->criarDiasDaSemana($request->all());
    }

    public function show($id)
    {
        return $this->diasDaSemanaService->procurarDiasDaSemanaPeloId($id);
    }

    public function update(Request $request, $id)
    {
        return $this->diasDaSemanaService->atualizarDiasDaSemana($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->diasDaSemanaService->excluirDiasDaSemana($id);
    }
}
