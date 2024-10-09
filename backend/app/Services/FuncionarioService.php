<?php

namespace App\Services;

use App\Repositories\FuncionarioRepository;
use Exception;

class FuncionarioService
{
	protected $funcionarioRepository;

	public function __construct(FuncionarioRepository $funcionarioRepository)
	{
		$this->funcionarioRepository = $funcionarioRepository;
	}

	public function listarFuncionarios()
	{
		return $this->funcionarioRepository->all();
	}

	public function criarFuncionario(array $data)
	{
		$funcionario = $this->funcionarioRepository->firstOrNew(['matricula' => $data['matricula']]);
		if ($funcionario['id'] == null) {
			$funcionario = $this->funcionarioRepository->create($data);
			return response()->json([
				'message' => 'Funcionário cadastrado com sucesso!',
			], 201);
		} else {
			throw new Exception('Funcionário já cadastrado!');
		}
	}

	public function procurarFuncionarioPeloId($id)
	{
		if ($id == null)
			throw new Exception('ID não informado!');

		$funcionario = $this->funcionarioRepository->find($id);

		if ($funcionario == null)
			throw new Exception('Funcionário não encontrado!');

		return $funcionario;
	}

	public function atualizarFuncionario(array $data, $id)
	{
		$funcionario = $this->funcionarioRepository->find($id);
		if ($funcionario == null)
			throw new Exception('Funcionário não encontrado!');

		return $this->funcionarioRepository->update($data, $id);
	}

	public function excluirFuncionario($id)
	{
		$funcionario = $this->funcionarioRepository->find($id);
		if ($funcionario == null)
			throw new Exception('Funcionário não encontrado!');
		$this->funcionarioRepository->delete($id);
		return response()->json([
			'message' => 'Funcionário deletado com sucesso!',
		], 200);
	}

	public function procurarFuncionarioPelaMatricula($matricula)
	{
		if ($matricula == null)
			throw new Exception('Matrícula não informada!');

		$funcionario = $this->funcionarioRepository->procurarFuncionarioPelaMatricula($matricula);

		if ($funcionario == null)
			throw new Exception('Funcionário não encontrado!');

		return $funcionario;
	}
}
