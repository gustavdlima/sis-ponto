<?php

namespace App\Repositories;

use App\Models\DiasDaSemana;

class DiasDaSemanaRepository {
	protected $model;

	public function __construct(DiasDaSemana $model)
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
		$diasDaSemana = $this->model->find($id);
		$diasDaSemana->update($data);
		return $diasDaSemana;
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}
}
