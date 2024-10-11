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

    public function registrarPonto(Request $request)
    {
        return $this->pontoService->registrarPonto($request);
    }
}
