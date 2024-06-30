<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiasDaSemana;

class DiasDaSemanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diasDaSemana = DiasDaSemana::all();
        return $diasDaSemana;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'segunda' => 'integer|nullable',
            'terca' => 'integer|nullable',
            'quarta' => 'integer|nullable',
            'quinta' => 'integer|nullable',
            'sexta' => 'integer|nullable',
            'sabado' => 'integer|nullable',
            'domingo' => 'integer|nullable',
        ]);

        $diasDaSemana = DiasDaSemana::firstOrNew([
            'segunda' => $request->segunda,
            'terca' => $request->terca,
            'quarta' => $request->quarta,
            'quinta' => $request->quinta,
            'sexta' => $request->sexta,
            'sabado' => $request->sabado,
            'domingo' => $request->domingo
        ]);
        if ($diasDaSemana['id'] == null) {
            $diasDaSemana = DiasDaSemana::create($request->all());
            return response()->json(['message' => 'Dias da semana criados com sucesso.'], 201);
        } else {
            $diasDaSemana->update($request->all());
            return response()->json(['message'=> 'Erro ao criar dias da semana'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $diasDaSemana = DiasDaSemana::findOrFail($id);
        return $diasDaSemana;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $diasDaSemana = DiasDaSemana::findOrFail($request->id);
        $diasDaSemana->update($request->all());
        $diasDaSemana->save();
        return response()->json(['message' => 'Dias da semana atualizados com sucesso.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $diasDaSemana = DiasDaSemana::findOrFail($request->id);
        $diasDaSemana->delete();
        return response()->json(['message' => 'Dias da semana deletados com sucesso.'], 200);
    }
}
