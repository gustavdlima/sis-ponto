<?php

namespace App\Services;

use App\Services\FuncionarioService;
use App\Services\FaltaService;
use App\Services\JustificativaService;
use App\Repositories\RegistroRepository;
use App\Helpers\DataHelper;
use DateTime;

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
			return $registro;
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

		return $registro;
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

	public function criarEstruturaDeRegistro($funcionario)
	{
		if ($funcionario == null)
		throw new Exception('Funcionário não informado!');

		$registroArray = array(
			'id_funcionario' => $funcionario->id,
			'id_horario' => $funcionario->id_horario,
			'primeiro_ponto' => null,
			'segundo_ponto' => null,
			'terceiro_ponto' => null,
			'quarto_ponto' => null,
			'atrasou_primeiro_ponto' => false,
			'atrasou_segundo_ponto' => false,
			'atrasou_terceiro_ponto' => false,
			'atrasou_quarto_ponto' => false
		);
		$registro = $this->registroRepository->create($registroArray);

		return $registro;
	}

	public function retornaUltimoRegistroDoFuncionario($idFuncionario)
	{
		if ($idFuncionario == null)
			throw new Exception('ID do funcionário não informado!');

		$registro = $this->registroRepository->retornaUltimoRegistroDoFuncionario($idFuncionario);

		if ($registro == null)
			return null;

        return $registro;
	}

	public function retornaTodoORegistroComJustificativa($idFuncionario)
	{

		$registros = $this->registroRepository->retornaTodoORegistroComJustificativa($idFuncionario);

		foreach ($registros as $registro) {
			if ($registro->data == null)
				continue;
			$data = DateTime::createFromFormat('d/m/Y', $registro->data);
			$dataISO = ($data->format('Y-m-d'));

			$registro->data = $dataISO;
		}

		return $registros;
	}

	public function adicionarAtrasoAoRegistro($registro, $indice)
    {
        switch ($indice) {
            case 0:
                $registro->atrasou_primeiro_ponto = true;
                return $this->registroRepository->update([
					'atrasou_primeiro_ponto' => true,
				], $registro->id);
            case 1:
                $registro->atrasou_segundo_ponto = true;
                return $this->registroRepository->update([
					'atrasou_segundo_ponto' => true,
				], $registro->id);
            case 2:
                $registro->atrasou_terceiro_ponto = true;
                return $this->registroRepository->update([
					'atrasou_terceiro_ponto' => true,
				], $registro->id);
            case 3:
                $registro->atrasou_quarto_ponto = true;
                return $this->registroRepository->update([
					'atrasou_quarto_ponto' => true,
				], $registro->id);
            default:
                return;
        }
    }

	public function adicionarSemRegistroNoPontoDoRegistro($registro, $indice)
	{
		switch ($indice) {
            case 0:
                $registro->primeiro_ponto = "Sem Registro";
                return $this->registroRepository->update([
					'primeiro_ponto' => "Sem Registro",
				], $registro->id);
            case 1:
                $registro->segundo_ponto = "Sem Registro";
                return $this->registroRepository->update([
					'segundo_ponto' => "Sem Registro",
				], $registro->id);
            case 2:
                $registro->terceiro_ponto = "Sem Registro";
                return $this->registroRepository->update([
					'terceiro_ponto' => "Sem Registro",
				], $registro->id);
            case 3:
                $registro->quarto_ponto = "Sem Registro";
               return $this->registroRepository->update([
					'quarto_ponto' => "Sem Registro",
				], $registro->id);
            default:
                return;
        }
	}

	public function retornaORegistroDoDia($matricula)
	{
		if ($matricula == null)
			throw new Exception('Matrícula não informada!');

		$funcionario = $this->funcionarioService->procurarFuncionarioPelaMatricula($matricula);

		$registro = $this->retornaUltimoRegistroDoFuncionario($funcionario->id);

		if ($registro == null)
			throw new Exception('Registro não encontrado!');

		$registro = $this->padronizarRegistroDoDia($registro);

		return $registro;
	}

	private function padronizarRegistroDoDia($registro)
    {
		return $registro;
        if ($registro->atrasou_primeiro_ponto == true && $registro->primeiro_ponto != "Sem Registro")
            $registro->primeiro_ponto = "Atrasado";
        if ($registro->atrasou_segundo_ponto == true && $registro->segundo_ponto != "Sem Registro")
            $registro->segundo_ponto = "Atrasado";
        if ($registro->atrasou_terceiro_ponto == true && $registro->terceiro_ponto != "Sem Registro")
            $registro->terceiro_ponto = "Atrasado";
        if ($registro->atrasou_quarto_ponto == true && $registro->quarto_ponto != "Sem Registro")
            $registro->quarto_ponto = "Atrasado";

        return $registro;
    }
}
