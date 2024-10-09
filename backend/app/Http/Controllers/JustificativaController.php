<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Justificativa;
use App\Http\Requests\JustificativaRequest;
use App\Services\JustificativaService;

class JustificativaController extends Controller
{

    protected $justificativaService;

    public function __construct(JustificativaService $justificativaService)
    {
        $this->justificativaService = $justificativaService;
    }

    public function index()
    {
        $justificativas = Justificativa::all();

        return response()->json($justificativas);
    }

    public function store(JustificativaRequest $request)
    {
        $justificativa = Justificativa::create($request->all());

        return response()->json($justificativa, 201);
    }

    public function show($id)
    {
        $justificativa = Justificativa::find($id);

        return response()->json($justificativa);
    }

    public function update(JustificativaRequest $request, $id)
    {
        $justificativa = Justificativa::find($id);
        $justificativa->update($request->all());

        return response()->json($justificativa, 200);
    }

    public function destroy($id)
    {
        Justificativa::destroy($id);

        return response()->json(null, 204);
    }

    public function justificativaFuncionario($id)
    {
        $justificativas = Justificativa::where('id_funcionario', $id)->get();

        return response()->json($justificativas);
    }

    public function retornaAJustificativaDoDiaDoFuncionario($funcionario, $data)
    {
        return $this->justificativaService->retornaAJustificativaDoDiaDoFuncionario($funcionario, $data);
    }
}
