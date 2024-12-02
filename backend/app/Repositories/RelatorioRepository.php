<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RelatorioRepository
{
    public function gerarRelatorio($mes, $ano, $idFuncionario)
    {
        $mesFormatado = str_pad($mes, 2, '0', STR_PAD_LEFT);
        $dataInicial = "01/$mesFormatado/$ano";

        return DB::select(<<<SQL
            WITH dias_do_mes AS (
                SELECT
                    generate_series(
                        date_trunc('month', TO_DATE(?, 'DD/MM/YYYY')),
                        date_trunc('month', TO_DATE(?, 'DD/MM/YYYY')) + interval '1 month - 1 day',
                        interval '1 day'
                    )::date AS data
            )
            SELECT
                TO_CHAR(dias_do_mes.data, 'DD/MM/YYYY') AS data,
                CASE
                    WHEN extract(dow from dias_do_mes.data) = 0 THEN 'Domingo'
                    WHEN extract(dow from dias_do_mes.data) = 1 THEN 'Segunda-Feira'
                    WHEN extract(dow from dias_do_mes.data) = 2 THEN 'Terça-Feira'
                    WHEN extract(dow from dias_do_mes.data) = 3 THEN 'Quarta-Feira'
                    WHEN extract(dow from dias_do_mes.data) = 4 THEN 'Quinta-Feira'
                    WHEN extract(dow from dias_do_mes.data) = 5 THEN 'Sexta-Feira'
                    WHEN extract(dow from dias_do_mes.data) = 6 THEN 'Sábado'
                END AS "diaSemana",
                r.nome,
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
                COALESCE(r.atrasou_primeiro_ponto, false) AS atrasou_primeiro_ponto,
                COALESCE(r.atrasou_segundo_ponto, false) AS atrasou_segundo_ponto,
                COALESCE(r.atrasou_terceiro_ponto, false) AS atrasou_terceiro_ponto,
                COALESCE(r.atrasou_quarto_ponto, false) AS atrasou_quarto_ponto,
                COALESCE(fa.justificativa, '-') AS justificativa
            FROM dias_do_mes
            LEFT JOIN (
                SELECT
                    f.nome,
                    r.created_at,
                    r.primeiro_ponto,
                    r.segundo_ponto,
                    r.terceiro_ponto,
                    r.quarto_ponto,
                    r.atrasou_primeiro_ponto,
                    r.atrasou_segundo_ponto,
                    r.atrasou_terceiro_ponto,
                    r.atrasou_quarto_ponto
                FROM registros r
                LEFT JOIN funcionarios f ON f.id = r.id_funcionario
                WHERE f.id = ?
            ) r ON TO_CHAR(dias_do_mes.data, 'DD/MM/YYYY') = TO_CHAR(r.created_at, 'DD/MM/YYYY')
            LEFT JOIN (
                SELECT
                    fa.id_funcionario,
                    fa.data,
                    fa.data2,
                    j.justificativa
                FROM faltas fa
                LEFT JOIN justificativas j ON j.id = fa.id_justificativa
                WHERE fa.id_funcionario = ?
            ) fa ON dias_do_mes.data BETWEEN fa.data AND fa.data2
            ORDER BY dias_do_mes.data;
        SQL, [$dataInicial, $dataInicial, $idFuncionario, $idFuncionario]);
    }
}
