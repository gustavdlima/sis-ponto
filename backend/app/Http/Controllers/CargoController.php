<?php

namespace App\Http\Controllers;

use App\Http\Requests\CargoRequest;
use App\Services\CargoService;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    protected $cargoService;

    public function __construct(CargoService $cargoService)
    {
        $this->cargoService = $cargoService;
    }

    public function index()
    {
        return $this->cargoService->listarCargos();
    }

    public function store(CargoRequest $request)
    {
        return $this->cargoService->criarCargo($request->all());
    }

    public function show($id)
    {
        return $this->cargoService->procurarCargoPeloId($id);
    }

    public function update(CargoRequest $request, $id)
    {
        return $this->cargoService->atualizarCargo($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->cargoService->excluirCargo($id);
    }
}
