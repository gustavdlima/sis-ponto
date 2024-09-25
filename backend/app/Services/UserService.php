<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;

class UserService
{
	protected $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function listarUsuarios()
	{
		return $this->userRepository->all();
	}

	public function criarUsuario(array $data)
	{
		$user = $this->userRepository->firstOrNew(['email' => $data['email']]);
		if ($user['id'] == null) {
			$user = $this->userRepository->create($data);
			return response()->json([
				'message' => 'Usuário criado com sucesso!',
			], 201);
		} else
			throw new Exception('Usuário já cadastrado');
	}

	public function procurarUsuarioPeloId($id)
	{
		if ($id == null)
			throw new Exception('ID não informado!');

		$user = $this->userRepository->find($id);
		if ($user == null)
			throw new Exception('Usuário não encontrado!');

		return $user;
	}

	public function atualizarUsuario(array $data, $id)
	{
		$user = $this->userRepository->find($id);
		if ($user == null)
			throw new Exception('Usuário não encontrado!');

		$this->userRepository->update($data, $id);
		return response()->json([
			'message' => 'Usuário atualizado com sucesso!',
		], 200);
	}

	public function excluirUsuario($id)
	{
		$user = $this->userRepository->find($id);
		if ($user == null)
			throw new Exception('Usuário não encontrado!');

		$this->userRepository->delete($id);
		return response()->json([
			'message' => 'Usuário excluído com sucesso!',
		], 200);
	}
}
