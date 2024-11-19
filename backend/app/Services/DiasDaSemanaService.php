<?php

namespace App\Services;

use App\Repositories\DiasDaSemanaRepository;
use Exception;

class DiasDaSemanaService
{
	protected $diasDaSemanaRepository;

	public function __construct(DiasDaSemanaRepository $diasDaSemanaRepository)
	{
		$this->diasDaSemanaRepository = $diasDaSemanaRepository;
	}

	public function listarDiasDaSemana()
	{
		return $this->diasDaSemanaRepository->all();
	}

	public function criarDiasDaSemana(array $data)
	{
		$diasDaSemana = $this->diasDaSemanaRepository->firstOrNew(['segunda' => $data['segunda'],
			'terca' => $data['terca'],
			'quarta' => $data['quarta'],
			'quinta' => $data['quinta'],
			'sexta' => $data['sexta'],]);

		if ($diasDaSemana['id'] == null) {
			$diasDaSemana = $this->diasDaSemanaRepository->create($data);
			return response()->json([
				'message' => 'Dia da semana cadastrado com sucesso!',
				'diasDaSemana' => $diasDaSemana,
			], 201);
		} else {
			return response()->json([
				'message' => 'Dia da semana já cadastrado!',
				'diasDaSemana' => $diasDaSemana,
			], 200);
		}
	}

	public function procurarDiasDaSemanaPeloId($id)
	{
		if ($id == null)
			throw new Exception('ID não informado!');

		$diasDaSemana = $this->diasDaSemanaRepository->find($id);
		if ($diasDaSemana == null)
			throw new Exception('Dia da semana não encontrado!');

		return $diasDaSemana;
	}

	public function atualizarDiasDaSemana(array $data, $id)
	{
		$diasDaSemana = $this->diasDaSemanaRepository->find($id);
		if ($diasDaSemana == null)
			throw new Exception('Dia da semana não encontrado!');

		$this->diasDaSemanaRepository->update($data, $id);
		return response()->json([
			'message' => 'Dia da semana atualizado com sucesso!',
		], 200);
	}

	public function excluirDiasDaSemana($id)
	{
		$diasDaSemana = $this->diasDaSemanaRepository->find($id);
		if ($diasDaSemana == null)
			throw new Exception('Dia da semana não encontrado!');

		$this->diasDaSemanaRepository->delete($id);
		return response()->json([
			'message' => 'Dia da semana deletado com sucesso!',
		], 200);
	}

	public function retornaTabelaDoDiaDaSemanaDoFuncionario($funcionario)
	{
		$tabelaDiasDaSemana = $this->diasDaSemanaRepository->retornaTabelaDoDiaDaSemanaDoFuncionario($funcionario);

		if ($tabelaDiasDaSemana == null || count($tabelaDiasDaSemana) == 0)
			return null;
		return $tabelaDiasDaSemana;
	}

}


