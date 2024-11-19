<?php

namespace App\Services;

use App\Repositories\JustificativaRepository;

use Exception;

class JustificativaService
{
	protected $justificativaRepository;

	public function __construct(JustificativaRepository $justificativaRepository)
	{
		$this->justificativaRepository = $justificativaRepository;
	}

	public function listarJustificativas()
	{
		return $this->justificativaRepository->all();
	}

	public function criarJustificativa(array $data)
	{
		$justificativa = $this->justificativaRepository->firstOrNew($data);
		if ($justificativa['id'] == null) {
			$justificativa = $this->justificativaRepository->create($data);
			return response()->json([
				'message' => 'Justificativa criada com sucesso!',
			], 201);
		} else
			throw new Exception('Justificativa já cadastrada');
	}

	public function procurarJustificativaPeloId($id)
	{
		if ($id == null)
			throw new Exception('ID não informado!');

		$justificativa = $this->justificativaRepository->find($id);
		if ($justificativa == null)
			throw new Exception('Justificativa não encontrada!');

		return $justificativa;
	}

	public function atualizarJustificativa(array $data, $id)
	{
		$justificativa = $this->justificativaRepository->find($id);
		if ($justificativa == null)
			throw new Exception('Justificativa não encontrada!');

		$this->justificativaRepository->update($data, $id);
		return response()->json([
			'message' => 'Justificativa atualizada com sucesso!',
		], 200);
	}

	public function excluirJustificativa($id)
	{
		$justificativa = $this->justificativaRepository->find($id);
		if ($justificativa == null)
			throw new Exception('Justificativa não encontrada!');

		$this->justificativaRepository->delete($id);
		return response()->json([
			'message' => 'Justificativa excluída com sucesso!',
		], 200);
	}

	public function retornaAJustificativaDoDiaDoFuncionario($funcionario, $data)
	{
		return $this->justificativaRepository->retornaAJustificativaDoDiaDoFuncionario($funcionario, $data);
	}

}
