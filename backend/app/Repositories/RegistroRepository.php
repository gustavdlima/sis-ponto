<?php

namespace App\Repositories;

use App\Models\Registro;

class RegistroRepository
{
	protected $model;

	public function __construct(Registro $model)
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
		$registro = $this->model->find($id);
		$registro->update($data);
		return $registro;
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}

	public function retornaTodoORegistroDoFuncionario($funcionario)
	{
		return $this->model->where('id_funcionario', $funcionario->id)
			->orderBy('created_at', 'desc')->get();
	}

	public function retornaOUltimoRegistroDoFuncionario($funcionario)
	{
		return Registro::where('id_funcionario', $funcionario->id)->latest()->first();
	}

	public function retornaORegistroDaDataEspecificada($funcionario, $data)
	{
		return Registro::where('id_funcionario', $funcionario->id)->whereMonth('created_at', date('m', strtotime($data)))->whereYear('created_at', date('Y', strtotime($data)))->whereDay('created_at', date('d', strtotime($data)))->get();

	}

}
