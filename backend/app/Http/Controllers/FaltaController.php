<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Falta;
use App\Models\Registro;
use DateTime;
date_default_timezone_set('America/Sao_Paulo');

class FaltaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faltas = DB::select('select * from faltas');
        return $faltas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_justificativa' => 'required',
            'id_funcionario' => 'required',
            'data' => 'required',
            'data2' => 'required',
        ]);

        $falta = DB::table('faltas')
                ->select('data')
                ->where('id_funcionario', $request->id_funcionario)
                ->where('data', $request->data)
                ->get();

        if ($falta->count() <= 0) {
            $falta = Falta::create($request);
            return "Falta registrada com sucesso";
        } else {
            return "Falta ja registrada";
        }

        return $falta;
    }

    /**
     * Display the specified resource from Funcionario.
     */
    public function retornaFaltasDoFuncionario(string $id_funcionario)
    {
        $falta = DB::select('select * from faltas where id_funcionario = ?', [$id_funcionario]);
        return $falta;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $falta = Falta::find($request->id);
        $falta->update($request->all());
        $falta->save();
        return response ()->json([
            'message' => 'Falta atualizada com sucesso!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $falta = Falta::find($request->id);
        $falta->delete();
        return response()->json([
            'message' => 'Falta deletada com sucesso!',
        ], 200);
    }
}
