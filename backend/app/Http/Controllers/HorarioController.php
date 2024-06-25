<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $horarios = DB::select('select * from horarios');
        return $horarios;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($data)
    {
        $horario = Horario::create($data);
        return $horario;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar a request
        $validated = $request->validate([
            'primeiro_horario' => 'required|date_format:H:i:s',
            'segundo_horario' => 'required|date_format:H:i:s',
        ]);

        $horario = Horario::firstOrNew(['primeiro_horario' => $request->primeiro_horario,
            'segundo_horario' => $request->segundo_horario,
            'terceiro_horario' => $request->terceir_horario,
            'quarto_horario' => $request->quarto_horario]);
        if ($horario['id'] == null) {
            $horario = Horario::create($request->all());
            return response()->json(['message' => 'Horário criado com sucesso.'], 201);
        } else {
            $horario->update($request->all());
            return response()->json(['message'=> 'Erro ao criar Horário'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $horario = Horario::findOrFail($id);
        return $horario;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        return redirect()->route('horarios.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $horario = Horario::findOrFail($request->id);
        $horario->update($request->all());
        $horario->save();

        return response ()->json([
            'message' => 'Horário atualizado com sucesso!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $horario = Horario::findOrFail($request->id);
        $horario->delete();
        return response()->json(['message' => 'Horário deletado.'], 200);
    }
}
