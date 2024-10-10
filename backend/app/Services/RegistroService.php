<?php

namespace App\Services;

use App\Services\FuncionarioService;
use App\Services\FaltaService;
use App\Services\JustificativaService;
use App\Repositories\RegistroRepository;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;

use Exception;

class RegistroService
{
	protected $registroRepository;
	protected $dataHelper;
	protected $funcionarioService;
	protected $faltaService;

	protected $justificativaService;

	public function __construct(RegistroRepository $registroRepository, DataHelper $dataHelper, FuncionarioService $funcionarioService, FaltaService $faltaService, JustificativaService $justificativaService)
	{
		$this->registroRepository = $registroRepository;
		$this->dataHelper = $dataHelper;
		$this->funcionarioService = $funcionarioService;
		$this->faltaService = $faltaService;
		$this->justificativaService = $justificativaService;
	}

	public function listarRegistros()
	{
		return $this->registroRepository->all();
	}

	public function criarRegistro(array $data)
	{
		$registro = $this->registroRepository->firstOrNew(['id_funcionario' => $data['id_funcionario'], 'created_at' => $data['created_at']]);
		if ($registro['id'] == null) {
			$registro = $this->registroRepository->create($data);
			return response()->json([
				'message' => 'Registro cadastrado com sucesso!',
			], 201);
		} else {
			throw new Exception('Registro já cadastrado!');
		}
	}

	public function procurarRegistroPeloId($id)
	{
		if ($id == null)
			throw new Exception('ID não informado!');

		$registro = $this->registroRepository->find($id);
		if ($registro == null)
			throw new Exception('Registro não encontrado!');

		return $registro;
	}

	public function atualizarRegistro(array $data, $id)
	{
		$registro = $this->registroRepository->find($id);
		if ($registro == null)
			throw new Exception('Registro não encontrado!');

		$this->registroRepository->update($data, $id);
		return response()->json([
			'message' => 'Registro atualizado com sucesso!',
		]);
	}

	public function excluirRegistro($id)
	{
		$registro = $this->registroRepository->find($id);
		if ($registro == null)
			throw new Exception('Registro não encontrado!');

		$this->registroRepository->delete($id);
		return response()->json([
			'message' => 'Registro excluído com sucesso!',
		]);
	}

}
