<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{

    public function fillRegistroWithPonto($registroFuncionario, $ponto, $date)
    {
        Db::table('registros')
                ->where('id', $registroFuncionario->id)
                ->update([$ponto => $date]);
        $registro = Registro::latest()->first();

        return $registro;
    }

    public function checkWhichPonto($registroFuncionario)
    {
        $registroArray = $registroFuncionario->toArray();

        foreach ($registroArray as $key => $value) {
            if ($key == 'primeiro_ponto' && $value == null) {
                return $key;
            }
            if ($key == 'segundo_ponto' && $value == null) {
                return $key;
            }
            if ($key == 'terceiro_ponto' && $value == null) {
                return $key;
            }
            if ($key == 'quarto_ponto' && $value == null) {
                return $key;
            }
        }
        return null;
    }

    public function checkIfTheRegistroWasCreatedOnTheSameDay($registroDate)
    {
        $date = date('Y-m-d');
        $rest = strpos($registroDate, $date);
        if ($rest !== false) {
            $split = explode('T', $registroDate);
            $split = explode(' ', $registroDate);
            $registroDate = $split[0];
            if ($registroDate == $date) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkIfFuncionarioHasRegistro($funcionarioId) {
        $registro = Registro::latest()->pluck('id_funcionario')->first();

        return $registro;
    }

    public function getLastFuncionarioRegistro($funcionarioId)
    {
        $registro = Registro::where('id_funcionario', $funcionarioId)->latest()->get()->first();

        return $registro;
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
        $id = Registro::create($registroJson);
        return $id;
    }

    public function createFirstPonto($registroArray, $date) {
        $registroArray['primeiro_ponto'] = $date;
        $newRegistro = $this->create($registroArray);
        return $newRegistro;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store($funcionario)
    {
        $date = date('Y-m-d H:i:s');

        // checar se está atrasado

        $registroFuncionario = $this->getLastFuncionarioRegistro($funcionario[0]->id);

        $registroArray = $this->createRegistroArray($funcionario);

        if ($registroFuncionario == null) {
            return $this->createFirstPonto($registroArray, $date);
        } else {
            if ($this->checkIfTheRegistroWasCreatedOnTheSameDay($registroFuncionario->created_at) !== false) {
                $ponto = $this->checkWhichPonto($registroFuncionario);
                if (!$ponto)
                    return $this->createFirstPonto($registroArray, $date);
                $newRegistro = $this->fillRegistroWithPonto($registroFuncionario, $ponto, $date);
                return $newRegistro;
            } else {
                return $this->createFirstPonto($registroArray, $date);
            }
        }
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
