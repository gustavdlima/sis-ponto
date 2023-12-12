<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function setHorario($horarioInput)
    {
        $horarioObject = null;

        if ($horarioInput == "horario1") {
            $horarioObject = json_encode(array('horario_entrada' => '08:00:00',
                'horario_ida_intervalo' => '12:00:00',
                'horario_volta_intervalo' => '13:00:00',
                'horario_saida' => '18:00:00', JSON_UNESCAPED_SLASHES));
        } elseif ($horarioInput == "horario2") {
            $horarioObject = json_encode(array('horario_entrada' => '07:30:00',
                'horario_ida_intervalo' => '11:30:00',
                'horario_volta_intervalo' => '12:30:00',
                'horario_saida' => '16:30:00', JSON_UNESCAPED_SLASHES));
        } elseif ($horarioInput == "horario3") {
            $horarioObject = json_encode(array('horario_entrada' => '07:00:00',
                'horario_ida_intervalo' => '11:00:00',
                'horario_volta_intervalo' => '12:00:00',
                'horario_saida' => '16:00:00', JSON_UNESCAPED_SLASHES));
        }

        return $horarioObject;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($input)
    {
        $input = json_decode($input, true);
        $id = Horario::create($input);
        return $id;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($input)
    {
        Horario::create($input);
    }

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horario $horario)
    {
        //
    }
}
