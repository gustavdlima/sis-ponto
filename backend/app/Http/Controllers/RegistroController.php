<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function checkWhichPonto($registroFuncionario, $registroArray)
    {
        $date = date('Y-m-d H:i:s');

        foreach ($registroArray as $key => $value) {
            $ponto = Registro::latest()->pluck($key)->first();
            if ($ponto == null) {
                $newRegistro = Registro::where('id', $registroFuncionario->id)->update([$key => $date]);
                return $newRegistro;
            } else {
                if ($key == 'quarto_ponto') {
                    $registroArray['primeiro_ponto'] = $date;
                    $registroArray['segundo_ponto'] = null;
                    $registroArray['terceiro_ponto'] = null;
                    $registroArray['quarto_ponto'] = null;
                    $newRegistro = $registroFuncionario->create($registroArray);
                    return $newRegistro;
                }
                continue ;
            }
        }
        return null;
    }

    public function getLastFuncionarioRegistro($funcionarioId)
    {
        $registros = Registro::latest()->where('id_funcionario', $funcionarioId)->get();
        if (sizeof($registros) == 0) {
            return null;
        }
        return $registros[0];
    }
    /**
     * Display a listing of the resource.
     */
    public function createRegistroArray($funcionario)
    {
        $registroArray = array(
            'id_funcionario' => $funcionario[0]->id,
            'primeiro_ponto' => null,
            'segundo_ponto' => null,
            'terceiro_ponto' => null,
            'quarto_ponto' => null,
        );

        return $registroArray;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($registroJson)
    {
        // $registro = json_decode($registroJson, true);
        $id = Registro::create($registroJson);
        return $id;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Registro $registro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registro $registro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registro $registro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registro $registro)
    {
        //
    }
}
