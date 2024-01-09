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
        $horarios = DB::table('horarios')->select(array('horario_entrada', 'horario_ida_intervalo', 'horario_volta_intervalo', 'horario_saida'))->get();
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
            'horario_entrada' => 'required|date_format:H:i:s',
            'horario_ida_intervalo' => 'required|date_format:H:i:s',
            'horario_volta_intervalo' => 'required|date_format:H:i:s',
            'horario_saida' => 'required|date_format:H:i:s',
        ]);

        $horario = Horario::firstOrNew(['horario_entrada' => $request->horario_entrada,
            'horario_ida_intervalo' => $request->horario_ida_intervalo,
            'horario_volta_intervalo' => $request->horario_volta_intervalo,
            'horario_saida' => $request->horario_saida]);
        if ($horario['id'] == null) {
            $horario = Horario::create($request->all());
            return "Horário criado com sucesso.";
        } else {
            $horario->update($request->all());
            return "Horário existente.";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
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
    public function update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);

        $validated = $request->validate([
            'horario_entrada' => 'required|date_format:H:i:s',
            'horario_ida_intervalo' => 'required|date_format:H:i:s',
            'horario_volta_intervalo' => 'required|date_format:H:i:s',
            'horario_saida' => 'required|date_format:H:i:s',
        ]);
        $horario->update($validated);

        return redirect()->route('horarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();

        return redirect()->route('horarios.index');
    }
}
