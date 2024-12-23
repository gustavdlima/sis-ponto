<?php

namespace App\Services;

use App\Repositories\FaltaRepository;
use App\Services\FuncionarioService;
use Exception;

class FaltaService
{
	protected $faltaRepository;
	protected $funcionarioService;

	public function __construct(FaltaRepository $faltaRepository, FuncionarioService $funcionarioService)
	{
		$this->faltaRepository = $faltaRepository;
		$this->funcionarioService = $funcionarioService;
	}

	public function listarFaltas()
	{
		return $this->faltaRepository->all();
	}

	public function criarFalta(array $data)
	{
		// verificar se já existe falta para o funcionario
		$funcionario = $this->funcionarioService->procurarFuncionarioPeloId($data['id_funcionario']);
		$falta = $this->faltaRepository->retornaAFaltaDoDiaDoFuncionario($funcionario, $data['data']);

		if ($falta == null) {
			$falta = $this->faltaRepository->create($data);
			return response()->json([
				'message' => 'Falta cadastrada com sucesso!',
			], 201);
		} else {
			throw new Exception('Falta já cadastrada!');
		}
	}

	public function procurarFaltaPeloId($id)
	{
		if ($id == null)
			throw new Exception('ID não informado!');

		$falta = $this->faltaRepository->find($id);
		if ($falta == null)
			throw new Exception('Falta não encontrada!');

		return $falta;
	}

	public function atualizarFalta(array $data, $id)
	{
		$falta = $this->faltaRepository->find($id);
		if ($falta == null)
			throw new Exception('Falta não encontrada!');
		$this->faltaRepository->update($data, $id);
		return response()->json([
			'message' => 'Falta atualizada com sucesso!',
		], 200);
	}

	public function excluirFalta($id)
	{
		$falta = $this->faltaRepository->find($id);
		if ($falta == null)
			throw new Exception('Falta não encontrada!');

		return $this->faltaRepository->delete($id);
	}

	public function faltasFuncionario($id)
	{
		if ($id == null)
			throw new Exception('ID não informado!');
		$faltas = $this->faltaRepository->faltasFuncionario($id);
		if ($faltas == null)
			throw new Exception('Faltas não encontradas!');
		return $faltas;
	}

	public function retornaAFaltaDoDiaDoFuncionario($funcionario, $data)
	{
		if ($funcionario == null)
			throw new Exception('Funcionário não informado!');
		if ($data == null)
			throw new Exception('Data não informada!');

		$falta = $this->faltaRepository->retornaAFaltaDoDiaDoFuncionario($funcionario, $data);

		if ($falta == null)
				return null;

		return $falta;
	}

	public function cadastraFaltaNoRegistro($funcionario, $data)
	{
		if ($funcionario == null)
			throw new Exception('Funcionário não informado!');
		if ($data == null)
			throw new Exception('Data não informada!');

		$falta = $this->faltaRepository->cadastraFaltaNoRegistro($funcionario, $data);

		if ($falta == null)
			throw new Exception('Falta não encontrada!');
		return $falta;
	}

}
