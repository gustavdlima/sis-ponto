<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Horario;
use DateTime;
date_default_timezone_set('America/Sao_Paulo');

class RegistroController extends Controller
{
    public function checkIfTheFuncionarioIsAheadOfSchedule($registroArray, $funcionario, $date) {
        $horario = $this->getFuncionarioHorario($funcionario[0]->id_horario);

        $registrationTime = $this->getJustTimeFromDate($date);
        $registrationTime = strtotime($registrationTime);

        $ponto = $this->checkWhichPonto($registroArray);
        switch ($ponto) {
            case 'primeiro_ponto':
                $horarioEntrada = strtotime($horario->primeiro_horario);
                $horarioEntrada = strtotime("-15 minutes", $horarioEntrada);

                if ($registrationTime < $horarioEntrada)
                    return "Volte 15 minutos antes do horário de entrada";
                break;
            case 'segundo_ponto':
               $horarioIdaIntervalo = strtotime($horario->segundo_horario);
                $horarioIdaIntervalo = strtotime("-15 minutes", $horarioIdaIntervalo);

                if ($registrationTime < $horarioIdaIntervalo)
                    return "Volte 15 minutos antes do horário de ida para intervalo";
                break;
            case 'terceiro_ponto':
                $horarioVoltaIntervalo = strtotime($horario->terceiro_horario);
                $horarioVoltaIntervalo = strtotime("-15 minutes", $horarioVoltaIntervalo);

                if ($registrationTime < $horarioVoltaIntervalo)
                    return "Volte 15 minutos antes do horário de volta para intervalo";
                break;
            case 'quarto_ponto':
                $horarioSaida = strtotime($horario->quarto_horario);
                $horarioSaida = strtotime("-15 minutes", $horarioSaida);

                if ($registrationTime < $horarioSaida)
                    return "Volte 15 minutos antes do horário de saida";
                break;
        }

        return null;
    }

    public function getJustTimeFromDate($date) {
        $split = explode(' ', $date);
        $time = $split[1];
        return $time;
    }

    public function getFuncionarioHorario($horarioId) {
        $horario = Horario::where('id', $horarioId)->first();
        return $horario;
    }

    public function checkIfTheFuncionarioIsLate($registroArray, $funcionario, $date)
    {
        $horario = $this->getFuncionarioHorario($funcionario[0]->id_horario);
        $ponto = $this->checkWhichPonto($registroArray);

        $registrationTime = $this->getJustTimeFromDate($date);
        $split = explode(':', $registrationTime);
        $registrationHour = intval($split[0]);
        $registrationMinute = intval($split[1]);

        switch ($ponto) {
            case 'primeiro_ponto':
                $split = explode(':', $horario->primeiro_horario);
                $horarioHour = intval($split[0]);
                $horarioMinute = intval($split[1]) + 15;

                if ($registrationHour > $horarioHour)
                    $registroArray['atrasou_primeiro_ponto'] = true;
                else if ($registrationHour == $horarioHour && $registrationMinute > $horarioMinute)
                    $registroArray['atrasou_primeiro_ponto'] = true;

                return $registroArray;
                break;
            case 'segundo_ponto':
                $split = explode(':', $horario->segundo_horario);
                $horarioHour = intval($split[0]);
                $horarioMinute = intval($split[1]) + 15;
                if ($registrationHour > $horarioHour)
                    $registroArray['atrasou_segundo_ponto'] = true;
                else if ($registrationHour == $horarioHour
                    && $registrationMinute > $horarioMinute)
                    $registroArray['atrasou_segundo_ponto'] = true;

                return $registroArray;
                break;
            case 'terceiro_ponto':
                $split = explode(':', $horario->terceiro_horario);
                $horarioHour = intval($split[0]);
                $horarioMinute = intval($split[1]) + 15;

                if ($registrationHour > $horarioHour)
                    $registroArray['atrasou_terceiro_ponto'] = true;
                else if ($registrationHour == $horarioHour
                    && $registrationMinute > $horarioMinute)
                    $registroArray['atrasou_terceiro_ponto'] = true;

                return $registroArray;
                break;
            case 'quarto_ponto':
                $split = explode(':', $horario->quarto_horario);
                $horarioHour = intval($split[0]);
                $horarioMinute = intval($split[1]) + 15;

                if ($registrationHour > $horarioHour)
                    $registroArray['atrasou_quarto_ponto'] = true;
                else if ($registrationHour == $horarioHour
                    && $registrationMinute > $horarioMinute)
                    $registroArray['atrasou_quarto_ponto'] = true;

                return $registroArray;
                break;
        }
        return $registroArray;
    }

    public function fillRegistroWithPonto($registroFuncionario, $ponto, $date)
    {

        if ($ponto == 'segundo_ponto') {
            Db::table('registros')
                ->where('id', $registroFuncionario->id)
                ->update([$ponto => $date,
                    'atrasou_segundo_ponto' => $registroFuncionario->atrasou_segundo_ponto,
                        ]);
        } else if ($ponto == 'terceiro_ponto') {
            Db::table('registros')
                ->where('id', $registroFuncionario->id)
                ->update([$ponto => $date,
                    'atrasou_terceiro_ponto' => $registroFuncionario->atrasou_terceiro_ponto,
                        ]);
        } else if ($ponto == 'quarto_ponto') {
            Db::table('registros')
                ->where('id', $registroFuncionario->id)
                ->update([$ponto => $date,
                    'atrasou_quarto_ponto' => $registroFuncionario->atrasou_quarto_ponto,
                        ]);
        }
        $registro = Registro::latest()->first();

        return $registro;
    }

    public function checkWhichPonto($registroFuncionario)
    {
        // tirei o toArray() daqui
        if (strcmp(gettype($registroFuncionario), 'object') == 0)
            $registroArray = $registroFuncionario->toArray();
        else
            $registroArray = $registroFuncionario;

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
            'id_horario' => $funcionario[0]->id_horario,
            'primeiro_ponto' => null,
            'segundo_ponto' => null,
            'terceiro_ponto' => null,
            'quarto_ponto' => null,
            'atrasou_primeiro_ponto' => false,
            'atrasou_segundo_ponto' => false,
            'atrasou_terceiro_ponto' => false,
            'atrasou_quarto_ponto' => false
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

    public function createFirstPonto($registroArray, $funcionario, $date) {
        $isEarly = $this->checkIfTheFuncionarioIsAheadOfSchedule($registroArray, $funcionario, $date);
        if ($isEarly != null)
            return $isEarly;
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

            $registroArray = $this->checkIfTheFuncionarioIsLate($registroArray, $funcionario, $date);
            $newRegistro = $this->createFirstPonto($registroArray, $funcionario, $date);

            return $newRegistro;
        } else {
            if ($this->checkIfTheRegistroWasCreatedOnTheSameDay($registroFuncionario->created_at) !== false) {

                $registroFuncionario = $this->checkIfTheFuncionarioIsLate($registroFuncionario, $funcionario, $date);

                $ponto = $this->checkWhichPonto($registroFuncionario);

                if (!$ponto) {
                    $registroArray = $this->checkIfTheFuncionarioIsLate($registroArray, $funcionario, $date);
                    return $this->createFirstPonto($registroArray, $funcionario, $date);
                } else {
                    // se o ponto existir, verifico o horario e se for antes do horario do funcionario bater o ponto, proibio de bater o ponto
                    $isEarly = $this->checkIfTheFuncionarioIsAheadOfSchedule($registroFuncionario, $funcionario, $date);
                    // return $isEarly;
                    if ($isEarly != null) {
                        return $isEarly;
                    }

                    $newRegistro = $this->fillRegistroWithPonto($registroFuncionario, $ponto, $date);
                    return $newRegistro;
                }
            } else {
                $registroArray = $this->checkIfTheFuncionarioIsLate($registroArray, $funcionario, $date);

                return $this->createFirstPonto($registroArray, $funcionario, $date);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function showAllFuncionarioRegistro(Request $request)
    {
        $funcionarios = Registro::where('id_funcionario', $request->id_funcionario)->get();
        return $funcionarios;
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
