<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
	protected $model;

	public function __construct(User $model)
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
		$user = $this->model->find($id);
		$user->update($data);
		return $user;
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}
}
