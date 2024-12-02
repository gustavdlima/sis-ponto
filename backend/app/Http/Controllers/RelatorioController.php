<?php

namespace App\Http\Controllers;

use App\Repositories\RelatorioRepository;
use Illuminate\Http\Request;
use App\Services\FuncionarioService;

class RelatorioController extends Controller
{
    protected $relatorioRepository;
	protected $funcionarioService;

    public function __construct(RelatorioRepository $relatorioRepository, FuncionarioService $funcionarioService)
	{
		$this->relatorioRepository = $relatorioRepository;
		$this->funcionarioService = $funcionarioService;
    }

    public function gerarRelatorioDeRegistroDoPonto(Request $request)
    {
        $relatorio = $this->relatorioRepository->gerarRelatorio($request->mes, $request->ano, $request->id_funcionario);

        return compact('relatorio');
    }
}
