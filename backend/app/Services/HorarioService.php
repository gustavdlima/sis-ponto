<?php

namespace App\Services;

use App\Repositories\HorarioRepository;
use Exception;

class HorarioService
{
	protected $horarioRepository;

	public function __construct(HorarioRepository $horarioRepository)
	{
		$this->horarioRepository = $horarioRepository;
	}

	public function listarHorarios()
	{
		return $this->horarioRepository->all();
	}

	public function criarHorario(array $data)
	{
		$horario = $this->horarioRepository->firstOrNew(['id_funcionario' => $data['id_funcionario']]);
		if ($horario['id'] == null) {
			$horario = $this->horarioRepository->create($data);
			return response()->json([
				'message' => 'Horário criado com sucesso!',
			], 201);
		} else
			throw new Exception('Horário já cadastrado');
	}

	public function procurarHorarioPeloId($id)
	{
		if ($id == null)
			throw new Exception('ID não informado!');

		$horario = $this->horarioRepository->find($id);
		if ($horario == null)
			throw new Exception('Horário não encontrado!');

		return $horario;
	}

	public function atualizarHorario(array $data, $id)
	{
		$horario = $this->horarioRepository->find($id);
		if ($horario == null)
			throw new Exception('Horário não encontrado!');

		$this->horarioRepository->update($data, $id);
		return response()->json([
			'message' => 'Horário atualizado com sucesso!',
		], 200);
	}

	public function excluirHorario($id)
	{
		$horario = $this->horarioRepository->find($id);
		if ($horario == null)
			throw new Exception('Horário não encontrado!');

		$this->horarioRepository->delete($id);
		return response()->json([
			'message' => 'Horário excluído com sucesso!',
		], 200);
	}

	public function retornaHorarioEmFormatoDeArray($id)
	{
        $horarios = $this->horarioRepository->find($id);
        if ($horarios == null)
            return null;

        $horarioArray = array();
        $horarioArray[0] = $horarios->primeiro_horario;
        $horarioArray[1] = $horarios->segundo_horario;
        if ($horarios->terceiro_horario != null)
            $horarioArray[2] = $horarios->terceiro_horario;
        if ($horarios->quarto_horario != null)
            $horarioArray[3] = $horarios->quarto_horario;

        return $horarioArray;
	}
}
