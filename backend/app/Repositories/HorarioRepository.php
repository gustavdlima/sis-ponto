<?php

namespace App\Repositories;

use App\Models\Horario;

class HorarioRepository
{
	protected $model;

	public function __construct(Horario $model)
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
		$horario = $this->model->find($id);
		$horario->update($data);
		return $horario;
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}

}
