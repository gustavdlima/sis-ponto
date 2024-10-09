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
		return $this->justificativaRepository->create($data);
	}

	public function procurarJustificativaPeloId($id)
	{
		return $this->justificativaRepository->find($id);
	}

	public function atualizarJustificativa(array $data, $id)
	{
		return $this->justificativaRepository->update($data, $id);
	}

	public function excluirJustificativa($id)
	{
		return $this->justificativaRepository->delete($id);
	}

}
