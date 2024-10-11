<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HorarioService;

class HorarioController extends Controller
{
    protected $horarioService;

    public function __construct(HorarioService $horarioService)
    {
        $this->horarioService = $horarioService;
    }

    public function index()
    {
        return $this->horarioService->listarHorarios();
    }

    public function store(Request $request)
    {
        return $this->horarioService->criarHorario($request->all());
    }

    public function show($id)
    {
        return $this->horarioService->procurarHorarioPeloId($id);
    }

    public function update(Request $request, $id)
    {
        return $this->horarioService->atualizarHorario($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->horarioService->excluirHorario($id);
    }

    public function retornaHorarioEmFormatoDeArray($id)
    {
        return $this->horarioService->retornaHorarioEmFormatoDeArray($id);
    }

}
