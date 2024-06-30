<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class RegistroController extends Controller
{
    /**
     * Lista o conteúdo de todos os registros.
     */
    public function index()
    {
        $registro = Registro::all();
        return $registro;
    }

    /**
     * Armazena um novo registro.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_funcionario' => 'required|integer|exists:funcionarios,id',
            'id_horario' => 'required|integer|exists:horarios,id',
            'id_falta' => 'string|exists:faltas,id|nullable',
            'data' => 'required|string',
            'primeiro_ponto' => 'string|nullable',
            'segundo_ponto' => 'string|nullable',
            'terceiro_ponto' => 'string|nullable',
            'quarto_ponto' => 'string|nullable',
            'atrasou_primeiro_ponto' => 'string|nullable',
            'atrasou_segundo_ponto' => 'string|nullable',
            'atrasou_terceiro_ponto' => 'string|nullable',
            'atrasou_quarto_ponto' => 'string|nullable',
        ]);

        $registro = Registro::create($validated);
        return response()->json([
            'message' => 'Registro criado com sucesso!',
            'registro' => $registro,
        ], 201);
    }

    /**
     * Exibe o registro especificado.
     */
    public function show($id)
    {
        $registro = Registro::find($id);
        if (!$registro)
            return response()->json([
                'message' => 'Registro não encontrado!',
            ], 404);
        return $registro;
    }

    /**
     * Atualiza o registro especificado.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id_funcionario' => 'required|integer|exists:funcionarios,id',
            'id_horario' => 'required|integer|exists:horarios,id',
            'id_falta' => 'string|exists:faltas,id',
            'data' => 'required|string',
            'primeiro_ponto' => 'string|nullable',
            'segundo_ponto' => 'string|nullable',
            'terceiro_ponto' => 'string|nullable',
            'quarto_ponto' => 'string|nullable',
            'atrasou_primeiro_ponto' => 'string|nullable',
            'atrasou_segundo_ponto' => 'string|nullable',
            'atrasou_terceiro_ponto' => 'string|nullable',
            'atrasou_quarto_ponto' => 'string|nullable',
        ]);

        $registro = Registro::find($request->id);

        if (!$registro)
            return response()->json([
                'message' => 'Registro não encontrado!',
            ], 404);

        $registro->update($request->all());

        return response()->json([
            'message' => 'Registro atualizado com sucesso!',
        ], 200);
    }

    /**
     * Remove o registro especificado.
     */
    public function destroy(Request $request)
    {
        $registro = Registro::find($request->id);

        if (!$registro)
            return response()->json([
                'message' => 'Registro não encontrado!',
            ], 404);

        $registro->delete();
        return response()->json([
            'message' => 'Registro deletado com sucesso!',
        ], 200);
    }
}
