<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PontoService;
use Exception;
use DateTime;


date_default_timezone_set('America/Sao_Paulo');

class PontoController extends Controller
{

    protected $pontoService;

    public function __construct(PontoService $pontoService)
    {
        $this->pontoService = $pontoService;
    }

    public function verificarPontoSemRegistro($horaAtual, $horaPonto)
    {
        // verifica se a hora atual tem uma diferença acima de 30 minutos do horário do ponto
        $horaAtual = new DateTime($horaAtual);
        $horaPonto = new DateTime($horaPonto);

        $diferenca = strtotime($horaAtual->format('H:i:s')) - strtotime($horaPonto->format('H:i:s'));

        if ($diferenca > 1800)
            return true;
        return false;
    }

    public function padronizarRegistroDoDia($registro, $funcionario)
    {
        // se o usuário estiver atrasado, adicionar atraso ao registro
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

    public function checaSeORegistroFoiCriadoNoMesmoDia($registro)
    {
        $date = date('Y-m-d');
        $createdAt = $registro->created_at;
        $split = explode('T', $createdAt);
        $split = explode(' ', $createdAt);
        $createdAt = $split[0];
        $date2 = date('Y-m-d', strtotime($createdAt));
        if ($date == $date2)
            return true;
        return false;
    }
    public function registrarPonto(Request $request)
    {
        return $this->pontoService->registrarPonto($request);
    }
}
