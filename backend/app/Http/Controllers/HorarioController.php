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
    // public function setHorario($horarioInput)
    // {
    //     $horarioObject = null;

    //     if ($horarioInput == "horario1") {
    //         $horarioObject = json_encode(array('horario_entrada' => '08:00:00',
    //             'horario_ida_intervalo' => '12:00:00',
    //             'horario_volta_intervalo' => '13:00:00',
    //             'horario_saida' => '18:00:00', JSON_UNESCAPED_SLASHES));
    //     } elseif ($horarioInput == "horario2") {
    //         $horarioObject = json_encode(array('horario_entrada' => '07:30:00',
    //             'horario_ida_intervalo' => '11:30:00',
    //             'horario_volta_intervalo' => '12:30:00',
    //             'horario_saida' => '16:30:00', JSON_UNESCAPED_SLASHES));
    //     } elseif ($horarioInput == "horario3") {
    //         $horarioObject = json_encode(array('horario_entrada' => '07:00:00',
    //             'horario_ida_intervalo' => '11:00:00',
    //             'horario_volta_intervalo' => '12:00:00',
    //             'horario_saida' => '16:00:00', JSON_UNESCAPED_SLASHES));
    //     }

    //     return $horarioObject;
    // }

    public function getArrayOfHorariosValues() {
        // $horarios = DB::select('select * from horarios');
        // return $ArrayHorario;
    }

    public function index()
    {
        $horarios = DB::table('horarios')->select(array('horario_entrada', 'horario_ida_intervalo', 'horario_volta_intervalo', 'horario_saida'))->get();
        return $horarios;
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
    public function store(Request $request)
    {
        $horario = new horario;
        $horario->horario_entrada = $request->horario_entrada;
        $horario->horario_ida_intervalo = $request->horario_ida_intervalo;
        $horario->horario_volta_intervalo = $request->horario_volta_intervalo;
        $horario->horario_saida = $request->horario_saida;
        $horario->save();
        return $horario;
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
