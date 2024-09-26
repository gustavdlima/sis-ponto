<?php

namespace App\Repositories;

use App\Models\Cargo;

class CargoRepository
{
	protected $model;

	public function __construct(Cargo $model)
	{
		$this->model = $model;
	}

	public function all()
	{
		return $this->model->all();
	}

	public function create(array $data)
	{
		return $this->model->create($data);
	}

	public function firstOrNew(array $data)
	{
		return $this->model->firstOrNew($data);
	}

	public function find($id)
	{
		return $this->model->find($id);
	}

	public function update(array $data, $id)
	{
		$cargo = $this->model->find($id);
		$cargo->update($data);
		return $cargo;
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}
}
