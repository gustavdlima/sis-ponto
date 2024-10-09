<?php

namespace App\Helpers;

class DataHelper
{
	public function converterDiaDaSemanaParaPortugues($diaDaSemana)
    {
        switch ($diaDaSemana) {
            case 'Sunday':
                return 'Domingo';
            case 'Monday':
                return 'Segunda-feira';
            case 'Tuesday':
                return 'Terça-feira';
            case 'Wednesday':
                return 'Quarta-feira';
            case 'Thursday':
                return 'Quinta-feira';
            case 'Friday':
                return 'Sexta-feira';
            case 'Saturday':
                return 'Sábado';
        }
    }

	public function tratarMesSelecionado($mesSelecionado)
    {
        if ($mesSelecionado != '10' || $mesSelecionado != '11' || $mesSelecionado != '12') {
            $mesSelecionado = '0' . $mesSelecionado;
        }

        return $mesSelecionado;
    }

	public function converteTimestampParaHoraConvencional($registro)
    {
        for ($i = 0; $i < count($registro); $i++) {
            if ($registro[$i]['primeiro_ponto'] != null && $registro[$i]['primeiro_ponto'] != 'FALTA' && $registro[$i]['primeiro_ponto'] != 'JUSTIFICATIVA' && $registro[$i]['primeiro_ponto'] != 'JUSTIFICADO' && $registro[$i]['primeiro_ponto'] != 'ATRASADO' && $registro[$i]['primeiro_ponto'] != 'Sem Registro')
                $registro[$i]['primeiro_ponto'] = date("H:i:s", strtotime($registro[$i]['primeiro_ponto']));
            if ($registro[$i]['segundo_ponto'] != null && $registro[$i]['segundo_ponto'] != 'FALTA' && $registro[$i]['segundo_ponto'] != 'JUSTIFICATIVA' && $registro[$i]['segundo_ponto'] != 'JUSTIFICADO' && $registro[$i]['segundo_ponto'] != 'ATRASADO' && $registro[$i]['segundo_ponto'] != 'Sem Registro')
                $registro[$i]['segundo_ponto'] = date("H:i:s", strtotime($registro[$i]['segundo_ponto']));
            if ($registro[$i]['terceiro_ponto'] != null && $registro[$i]['terceiro_ponto'] != 'FALTA' && $registro[$i]['terceiro_ponto'] != 'JUSTIFICATIVA' && $registro[$i]['terceiro_ponto'] != 'JUSTIFICADO' && $registro[$i]['terceiro_ponto'] != 'ATRASADO' && $registro[$i]['terceiro_ponto'] != 'Sem Registro')
                $registro[$i]['terceiro_ponto'] = date("H:i:s", strtotime($registro[$i]['terceiro_ponto']));
            if ($registro[$i]['quarto_ponto'] != null && $registro[$i]['quarto_ponto'] != 'FALTA' && $registro[$i]['quarto_ponto'] != 'JUSTIFICATIVA' && $registro[$i]['quarto_ponto'] != 'JUSTIFICADO' && $registro[$i]['quarto_ponto'] != 'ATRASADO' && $registro[$i]['quarto_ponto'] != 'Sem Registro')
                $registro[$i]['quarto_ponto'] = date("H:i:s", strtotime($registro[$i]['quarto_ponto']));
        }

        return $registro;
    }

}
