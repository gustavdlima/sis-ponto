<?php

namespace App\Repositories;

use App\Models\Justificativa;

class JustificativaRepository
{
	protected $model;

	public function __construct(Justificativa $model)
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
		$justificativa = $this->model->find($id);
		$justificativa->update($data);
		return $justificativa;
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}

	public function justificativaFuncionario($id)
	{
		$justificativas = Justificativa::where('id_funcionario', $id)->get();

		return $justificativas;
	}

}
