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

	public function retornaTodoORegistroDoFuncionario($funcionario)
    {
		$registro = $this->registroRepository->retornaTodoORegistroDoFuncionario($funcionario);


        $registro = $this->dataHelper->converteTimestampParaHoraConvencional($registro);

        for ($i = 0; $i < count($registro); $i++) {

			$registro[$i]['data'] = date("d/m/Y", strtotime($registro[$i]['created_at']));
            $registro[$i]['justificativa'] = $this->faltaService->retornaAFaltaDoDiaDoFuncionario($funcionario, date("Y-m-d", strtotime($registro[$i]['created_at'])));
        }

        $registro = $this->inserirJustificativaNoRegistro($registro);

        return $registro;
    }

	public function retornaOUltimoRegistroDoFuncionario($funcionario)
    {
        return $this->registroRepository->retornaOUltimoRegistroDoFuncionario($funcionario);
    }

	public function retornaORegistroDaDataEspecificada($funcionario, $data)
	{
		$registro = $this->registroRepository->retornaORegistroDaDataEspecificada($funcionario, $data);

		$registroNull = array(
			'primeiro_ponto' => 'Sem Registro',
			'segundo_ponto' => 'Sem Registro',
			'terceiro_ponto' => 'Sem Registro',
			'quarto_ponto' => 'Sem Registro',
		);

		if (count($registro) == 0) {
			return [$registroNull];
		}

		return $registro;
	}

	public function inserirJustificativaNoRegistro($relatorio)
	{
		for ($i = 0; $i < sizeof($relatorio); $i++) {
			if (isset($relatorio[$i]['justificativa']) && is_array($relatorio[$i]['justificativa']) && count($relatorio[$i]['justificativa']) > 0) {

				$justificativa = $this->justificativaService->procurarJustificativaPeloId($relatorio[$i]['justificativa'][0]['id_justificativa']);

				if ($justificativa && isset($justificativa[0])) {
					$relatorio[$i]['justificativa'] = $justificativa[0]->justificativa;
				}
			}
		}

		return $relatorio;
	}
}
