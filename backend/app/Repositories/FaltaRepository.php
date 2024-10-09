<?php

namespace App\Repositories;

use App\Models\Falta;

class FaltaRepository
{
	protected $model;

	public function __construct(Falta $model)
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
		$falta = $this->model->find($id);
		$falta->update($data);

		return $falta;
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}
	public function faltasFuncionario($id)
    {
        $faltas = Falta::where('id_funcionario', $id)->get();

        return $faltas;
    }
	public function retornaAFaltaDoDiaDoFuncionario($funcionario, $data)
    {
		$falta = Falta::where('id_funcionario', $funcionario->id)->where('data', $data)->first();
    	return $falta;
    }

	public function cadastraFaltaNoRegistro($funcionario, $data)
	{
		return Falta::where('id_funcionario', $funcionario->id)->where('data', 'like', '%' . $data . '%')->get();

    }

}
