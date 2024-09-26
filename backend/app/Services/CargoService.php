<?php

namespace App\Services;

use App\Repositories\CargoRepository;
use Exception;

class CargoService
{
	protected $cargoRepository;

	public function __construct(CargoRepository $cargoRepository)
	{
		$this->cargoRepository = $cargoRepository;
	}

	public function listarCargos()
	{
		return $this->cargoRepository->all();
	}

	public function criarCargo(array $data)
	{
		$cargo = $this->cargoRepository->firstOrNew(['cargo' => $data['cargo']]);
		if ($cargo['id'] == null) {
			$cargo = $this->cargoRepository->create($data);
			return response()->json([
				'message' => 'Cargo cadastrado com sucesso!',
			], 201);
		} else {
			throw new Exception('Cargo já cadastrado!');
		}
	}

	public function procurarCargoPeloId($id)
	{
		if ($id == null)
			throw new Exception('ID não informado!');

		$cargo = $this->cargoRepository->find($id);
		if ($cargo == null)
			throw new Exception('Cargo não encontrado!');

		return $cargo;
	}

	public function atualizarCargo(array $data, $id)
	{
		$cargo = $this->cargoRepository->find($id);
		if ($cargo == null)
			throw new Exception('Cargo não encontrado!');

		$this->cargoRepository->update($data, $id);
		return response()->json([
			'message' => 'Cargo atualizado com sucesso!',
		]);
	}

	public function excluirCargo($id)
	{
		$cargo = $this->cargoRepository->find($id);
		if ($cargo == null)
			throw new Exception('Cargo não encontrado!');

		$this->cargoRepository->delete($id);
		return response()->json([
			'message' => 'Cargo deletado com sucesso!',
		]);
	}
}
