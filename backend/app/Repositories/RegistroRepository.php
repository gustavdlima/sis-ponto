<?php

namespace App\Repositories;

use App\Models\Registro;
use Illuminate\Support\Facades\DB;

class RegistroRepository
{
	protected $model;

	public function __construct(Registro $model)
	{
		$this->model = $model;
	}

	public function all()
	{
		return $this->model->all();
	}

	public function create(array $data)
	{
		return $this->model->create($data);
	}

	public function firstOrNew(array $data)
	{
		return $this->model->firstOrNew($data);
	}

	public function find($id)
	{
		return $this->model->find($id);
	}

	public function update(array $data, $id)
	{
		$registro = $this->model->find($id);
		$registro->update($data);
		return $registro;
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}

    public function retornaUltimoRegistroDoFuncionario($idFuncionario)
    {
        return Registro::where('id_funcionario', $idFuncionario)->latest()->get()->first();
    }

	public function retornaTodoORegistroComJustificativa($idFuncionario)
	{
        return DB::select(<<<SQL
            WITH registros_ou_justificativas AS (
                -- Selecione apenas os dias onde há um registro ou uma justificativa
                SELECT DISTINCT
                    COALESCE(r.created_at::date, fa.data) AS data
                FROM registros r
                LEFT JOIN faltas fa ON r.id_funcionario = fa.id_funcionario
                    AND r.created_at::date BETWEEN fa.data AND fa.data2
                WHERE r.id_funcionario = ?
                UNION
                SELECT DISTINCT
                    fa.data AS data
                FROM faltas fa
                WHERE fa.id_funcionario = ?
            )
            SELECT
                TO_CHAR(ro.data, 'DD/MM/YYYY') AS data,
                CASE
                    WHEN extract(dow from ro.data) = 0 THEN 'Domingo'
                    WHEN extract(dow from ro.data) = 1 THEN 'Segunda-Feira'
                    WHEN extract(dow from ro.data) = 2 THEN 'Terça-Feira'
                    WHEN extract(dow from ro.data) = 3 THEN 'Quarta-Feira'
                    WHEN extract(dow from ro.data) = 4 THEN 'Quinta-Feira'
                    WHEN extract(dow from ro.data) = 5 THEN 'Sexta-Feira'
                    WHEN extract(dow from ro.data) = 6 THEN 'Sábado'
                END AS "diaSemana",
                CASE
                    WHEN r.primeiro_ponto IS NULL AND fa.id_funcionario IS NOT NULL THEN 'Justificado'
                    ELSE COALESCE(r.primeiro_ponto, '-')
                END AS primeiro_ponto,
                CASE
                    WHEN r.segundo_ponto IS NULL AND fa.id_funcionario IS NOT NULL THEN 'Justificado'
                    ELSE COALESCE(r.segundo_ponto, '-')
                END AS segundo_ponto,
                CASE
                    WHEN r.terceiro_ponto IS NULL AND fa.id_funcionario IS NOT NULL THEN 'Justificado'
                    ELSE COALESCE(r.terceiro_ponto, '-')
                END AS terceiro_ponto,
                CASE
                    WHEN r.quarto_ponto IS NULL AND fa.id_funcionario IS NOT NULL THEN 'Justificado'
                    ELSE COALESCE(r.quarto_ponto, '-')
                END AS quarto_ponto,
                COALESCE(fa.justificativa, '-') AS justificativa
            FROM registros_ou_justificativas ro
            LEFT JOIN (
                SELECT
                    r.created_at,
                    r.primeiro_ponto,
                    r.segundo_ponto,
                    r.terceiro_ponto,
                    r.quarto_ponto
                FROM registros r
                LEFT JOIN funcionarios f ON f.id = r.id_funcionario
                WHERE r.id_funcionario = ?
            ) r ON TO_CHAR(ro.data, 'DD/MM/YYYY') = TO_CHAR(r.created_at, 'DD/MM/YYYY')
            LEFT JOIN (
                SELECT
                    fa.id_funcionario,
                    fa.data,
                    fa.data2,
                    j.justificativa
                FROM faltas fa
                LEFT JOIN justificativas j ON j.id = fa.id_justificativa
                WHERE fa.id_funcionario = ?
            ) fa ON ro.data BETWEEN fa.data AND fa.data2
            ORDER BY ro.data;
        SQL, [$idFuncionario, $idFuncionario, $idFuncionario, $idFuncionario]);
	}
}
