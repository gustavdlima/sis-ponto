<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller
{

    public function checkIfIsTheSameDay($key, $registroFuncionario)
    {
        $date = date('Y-m-d');

        if ($key == 'primeiro_ponto') {
            return 1;
        } elseif ($key == 'segundo_ponto') {
            $ponto = Registro::latest()->pluck('primeiro_ponto')->first();
            $registroDate = explode(' ', $ponto);
            if ($registroDate[0] == $date)
                return 1;
            else
                return 0;
        } elseif ($key == 'terceiro_ponto') {
            $ponto = Registro::latest()->pluck('segundo_ponto')->first();
            $registroDate = explode(' ', $ponto);
            if ($registroDate[0] == $date)
                return 1;
            else
                return 0;
        } elseif ($key == 'quarto_ponto') {
            $ponto = Registro::latest()->pluck('terceiro_ponto')->first();
            $registroDate = explode(' ', $ponto);
            if ($registroDate[0] == $date)
                return 1;
            else
                return 0;
        }

    }

    public function checkWhichPonto($registroFuncionario, $registroArray)
    {
        $date = date('Y-m-d H:i:s');

        foreach ($registroArray as $key => $value) {
            $ponto = Registro::latest()->pluck($key)->first();
            if ($ponto == null) {
                if ($this->checkIfIsTheSameDay($key, $registroFuncionario)) {
                    $newRegistro = Registro::where('id', $registroFuncionario->id)->update([$key => $date]);
                    return $registroFuncionario;
                } else {
                    $registroArray['primeiro_ponto'] = $date;
                    $registroArray['segundo_ponto'] = null;
                    $registroArray['terceiro_ponto'] = null;
                    $registroArray['quarto_ponto'] = null;
                    $newRegistro = $registroFuncionario->create($registroArray);
                    return $registroFuncionario;
                }

            } else {
                if ($key == 'quarto_ponto') {
                    $registroArray['primeiro_ponto'] = $date;
                    $registroArray['segundo_ponto'] = null;
                    $registroArray['terceiro_ponto'] = null;
                    $registroArray['quarto_ponto'] = null;
                    $newRegistro = $registroFuncionario->create($registroArray);
                    return $registroFuncionario;

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
