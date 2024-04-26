<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Horario;
use App\Models\Funcionario;
use App\Models\Justificativa;
use DateTime;
use DateInterval;
use App\Models\Falta;


date_default_timezone_set('America/Sao_Paulo');

class RegistroController extends Controller
{
    public function encontrarHorarioFixoMaisProximo($horaAleatoria, $horarioFixo1, $horarioFixo2) {
        // Calcular diferenças absolutas
        $diferenca1 = abs(strtotime($horaAleatoria) - strtotime($horarioFixo1));
        $diferenca2 = abs(strtotime($horaAleatoria) - strtotime($horarioFixo2));

        // Encontrar a menor diferença
        $menorDiferenca = min($diferenca1, $diferenca2);

        // Identificar o horário fixo mais próximo
        if ($menorDiferenca === $diferenca1) {
          return $horarioFixo1;
        } else {
          return $horarioFixo2;
        }
    }

    public function separarHorarioDaData($date) {
        $split = explode(' ', $date);
        $time = $split[1];
        return $time;
    }

    public function getFuncionarioHorario($horarioId) {
        $horario = Horario::where('id', $horarioId)->first();
        return $horario;
    }

    public function checaQualPonto($registroFuncionario) {
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

    public function checaSeORegistroFoiCriadoNoMesmoDia($registroDate) {
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

    public function getUltimoRegistroDoFuncionario($funcionarioId) {
        $registro = Registro::where('id_funcionario', $funcionarioId)->latest()->get()->first();

        if ($registro == null) {
            return null;
        }

        return $registro;
    }

    public function createRegistroArray($funcionario) {
        $registroArray = array(
            'id_funcionario' => $funcionario->id,
            'id_horario' => $funcionario->id_horario,
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

    public function create($registroJson) {
        $id = Registro::create($registroJson);
        return $id;
    }

    public function checaSeOFuncionarioEstaAdiantadoPrimeiroPonto($registroFuncionario, $funcionario, $date) {
        $horarioFuncionario = $this->getFuncionarioHorario($funcionario->id_horario);
        $horarioDoRegistro = new DateTime($this->separarHorarioDaData($date));

        if ($registroFuncionario->primeiro_ponto == NULL) {
            $primeiroHorario = new DateTime($horarioFuncionario->primeiro_horario);
            $primeiroHorario->sub(new DateInterval('PT15M'));

            if ($horarioDoRegistro->getTimestamp() < $primeiroHorario->getTimestamp())
                return "Volte 15 minutos antes do horário de entrada do primeiro horário";
            return null;
        }
    }

    public function checaSeOFuncionarioEstaAdiantadoSegundoPonto($registroFuncionario, $funcionario, $date) {
        $horarioFuncionario = $this->getFuncionarioHorario($funcionario->id_horario);
        $horarioDoRegistro = new DateTime($this->separarHorarioDaData($date));

        if ($registroFuncionario->segundo_ponto == NULL) {
            $segundoHorario = new DateTime($horarioFuncionario->segundo_horario);
            $segundoHorario->sub(new DateInterval('PT15M'));

            if ($horarioDoRegistro->getTimestamp() < $segundoHorario->getTimestamp())
                return "Volte 15 minutos antes do horário de saída do primeiro horário";
            return null;
        }
    }

    public function checaSeOFuncionarioEstaAdiantadoTerceiroPonto($registroFuncionario, $funcionario, $date) {
        $horarioFuncionario = $this->getFuncionarioHorario($funcionario->id_horario);
        $horarioDoRegistro = new DateTime($this->separarHorarioDaData($date));

        if ($registroFuncionario->terceiro_ponto == NULL) {
            $terceiroHorario = new DateTime($horarioFuncionario->terceiro_horario);
            $terceiroHorario->sub(new DateInterval('PT15M'));
            if ($horarioDoRegistro->getTimestamp() < $terceiroHorario->getTimestamp())
                return "Volte 15 minutos antes do horário de entrada do segundo horário";
            return null;
        }
    }

    public function checaSeOFuncionarioEstaAdiantadoQuartoPonto($registroFuncionario, $funcionario, $date) {
        $horarioFuncionario = $this->getFuncionarioHorario($funcionario->id_horario);
        $horarioDoRegistro = new DateTime($this->separarHorarioDaData($date));

        if ($registroFuncionario->quarto_ponto == NULL) {
            $quartoHorario = new DateTime($horarioFuncionario->quarto_horario);
            $quartoHorario->sub(new DateInterval('PT15M'));

            if ($horarioDoRegistro->getTimestamp() < $quartoHorario->getTimestamp())
                return "Volte 15 minutos antes do horário de saída do segundo horário";
            return null;

        }
    }

    public function checaSeOFuncionarioEstaAtrasado($registroFuncionario, $funcionario, $date) {
        $horarioFuncionario = $this->getFuncionarioHorario($funcionario->id_horario);
        $horaDoPonto = $this->separarHorarioDaData($date);

        if ($funcionario->carga_horaria == "20h") {
            $horaFuncionarioArray[0] = $horarioFuncionario->primeiro_horario;
            $horaFuncionarioArray[1] = $horarioFuncionario->segundo_horario;
        }
        else if ($funcionario->carga_horaria == "40h") {
            $horaFuncionarioArray[0] = $horarioFuncionario->primeiro_horario;
            $horaFuncionarioArray[1] = $horarioFuncionario->segundo_horario;
            $horaFuncionarioArray[2] = $horarioFuncionario->terceiro_horario;
            $horaFuncionarioArray[3] = $horarioFuncionario->quarto_horario;
        }

        for($i = 0; $i < count($horaFuncionarioArray); $i++) {
            if ($registroFuncionario->primeiro_ponto == NULL) {
                $diferenca = strtotime($horaDoPonto) - strtotime($horarioFuncionario->primeiro_horario);
                $diferencaHora = floor($diferenca / 3600);
                $diferencaMinutos = floor(($diferenca % 3600) / 60);

                if (($diferencaHora > 0) || ($diferencaHora == 0 && $diferencaMinutos > 15)) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'atrasou_primeiro_ponto' => true,
                    ]);
                }
            }

            if ($registroFuncionario->segundo_ponto == NULL) {
                $diferenca = strtotime($horaDoPonto) - strtotime($horarioFuncionario->segundo_horario);
                $diferencaHora = floor($diferenca / 3600);
                $diferencaMinutos = floor(($diferenca % 3600) / 60);

                if (($diferencaHora > 0) || ($diferencaHora == 0 && $diferencaMinutos > 15)) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'atrasou_segundo_ponto' => true,
                    ]);
                }
            }

            if ($registroFuncionario->terceiro_ponto == NULL) {
                $diferenca = strtotime($horaDoPonto) - strtotime($horarioFuncionario->terceiro_horario);
                $diferencaHora = floor($diferenca / 3600);
                $diferencaMinutos = floor(($diferenca % 3600) / 60);

                if (($diferencaHora > 0) || ($diferencaHora == 0 && $diferencaMinutos > 15)) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'atrasou_terceiro_ponto' => true,
                    ]);
                }
            }

            if ($registroFuncionario->quarto_ponto == NULL) {
                $diferenca = strtotime($horaDoPonto) - strtotime($horarioFuncionario->quarto_horario);
                $diferencaHora = floor($diferenca / 3600);
                $diferencaMinutos = floor(($diferenca % 3600) / 60);

                if (($diferencaHora > 0) || ($diferencaHora == 0 && $diferencaMinutos > 15)) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'atrasou_quarto_ponto' => true,
                    ]);
                }
            }

        }

        return $this->getUltimoRegistroDoFuncionario($funcionario->id);
    }

    public function batePonto($funcionario, $registroFuncionario, $date) {

        $horarioFuncionario = $this->getFuncionarioHorario($funcionario->id_horario);
        $horaDoPonto = $this->separarHorarioDaData($date);
        if ($funcionario->carga_horaria == "20h") {
            $horaFuncionarioArray[0] = $horarioFuncionario->primeiro_horario;
            $horaFuncionarioArray[1] = $horarioFuncionario->segundo_horario;

        }
        else if ($funcionario->carga_horaria == "40h") {
            $horaFuncionarioArray[0] = $horarioFuncionario->primeiro_horario;
            $horaFuncionarioArray[1] = $horarioFuncionario->segundo_horario;
            $horaFuncionarioArray[2] = $horarioFuncionario->terceiro_horario;
            $horaFuncionarioArray[3] = $horarioFuncionario->quarto_horario;
        }

        for ($i = 0; $i < count($horaFuncionarioArray); $i++) {

            if ($registroFuncionario->primeiro_ponto == null && $this->checaSeOFuncionarioEstaAdiantadoPrimeiroPonto($registroFuncionario, $funcionario, $date) == null) {
                if ($registroFuncionario->atrasou_primeiro_ponto == true  &&
                $registroFuncionario->primeiro_ponto == null) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'primeiro_ponto' => "FALTA",
                        'atrasou_primeiro_ponto' => $registroFuncionario->atrasou_primeiro_ponto,
                    ]);
                } if ($registroFuncionario->atrasou_primeiro_ponto == false &&
                $registroFuncionario->primeiro_ponto == null) {
                    Db::table('registros')
                        ->where('id', $registroFuncionario->id)
                        ->update([
                            'primeiro_ponto' => $date,
                            'atrasou_primeiro_ponto' => $registroFuncionario->atrasou_primeiro_ponto,
                        ]);
                }
                $registroFuncionario = $this->getUltimoRegistroDoFuncionario($funcionario->id);
            }

            if ($registroFuncionario->segundo_ponto == null && $this->checaSeOFuncionarioEstaAdiantadoSegundoPonto($registroFuncionario, $funcionario, $date) == null) {
                if ($registroFuncionario->primeiro_ponto == null) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'primeiro_ponto' => "FALTA",
                        'atrasou_primeiro_ponto' => true,
                    ]);
                }
                if ($registroFuncionario->atrasou_segundo_ponto == true &&
                $registroFuncionario->segundo_ponto == null) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'segundo_ponto' => "FALTA",
                        'atrasou_segundo_ponto' => $registroFuncionario->atrasou_segundo_ponto,
                    ]);
                }
                if ($registroFuncionario->atrasou_segundo_ponto == false &&
                    $registroFuncionario->segundo_ponto == null) {
                    if ($registroFuncionario)
                    Db::table('registros')
                        ->where('id', $registroFuncionario->id)
                        ->update([
                            'segundo_ponto' => $date,
                            'atrasou_segundo_ponto' => $registroFuncionario->atrasou_segundo_ponto,
                        ]);
                }
                $registroFuncionario = $this->getUltimoRegistroDoFuncionario($funcionario->id);
            }

            if ($registroFuncionario->terceiro_ponto == null && $this->checaSeOFuncionarioEstaAdiantadoTerceiroPonto($registroFuncionario, $funcionario, $date) == null) {
                if ($registroFuncionario->segundo_ponto == null) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'primeiro_ponto' => "FALTA",
                        'segundo_ponto' => "FALTA",
                        'atrasou_primeiro_ponto' => true,
                        'atrasou_segundo_ponto' => true,
                    ]);
                }
                if ($registroFuncionario->atrasou_terceiro_ponto == true && $registroFuncionario->terceiro_ponto == null) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'terceiro_ponto' => "FALTA",
                        'atrasou_terceiro_ponto' => $registroFuncionario->atrasou_terceiro_ponto,
                    ]);
                } if ($registroFuncionario->atrasou_terceiro_ponto == false && $registroFuncionario->terceiro_ponto == null) {
                    Db::table('registros')
                        ->where('id', $registroFuncionario->id)
                        ->update([
                            'terceiro_ponto' => $date,
                            'atrasou_terceiro_ponto' => $registroFuncionario->atrasou_terceiro_ponto,
                        ]);
                }
                $registroFuncionario = $this->getUltimoRegistroDoFuncionario($funcionario->id);
            }

            if ($registroFuncionario->quarto_ponto == null && $this->checaSeOFuncionarioEstaAdiantadoQuartoPonto($registroFuncionario, $funcionario, $date) == null) {
                if ($registroFuncionario->terceiro_ponto == null) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'primeiro_ponto' => "FALTA",
                        'segundo_ponto' => "FALTA",
                        'terceiro_ponto' => "FALTA",
                        'atrasou_primeiro_ponto' => true,
                        'atrasou_segundo_ponto' => true,
                        'atrasou_terceiro_ponto' => true,
                    ]);
                }
                if ($registroFuncionario->atrasou_quarto_ponto == true && $registroFuncionario->quarto_ponto == null) {
                    Db::table('registros')
                    ->where('id', $registroFuncionario->id)
                    ->update([
                        'quarto_ponto' => "FALTA",
                        'atrasou_quarto_ponto' => $registroFuncionario->atrasou_quarto_ponto,
                    ]);
                } if ($registroFuncionario->atrasou_quarto_ponto == false && $registroFuncionario->quarto_ponto == null) {
                    Db::table('registros')
                        ->where('id', $registroFuncionario->id)
                        ->update([
                            'quarto_ponto' => $date,
                            'atrasou_quarto_ponto' => $registroFuncionario->atrasou_quarto_ponto,
                        ]);
                }
                $registroFuncionario = $this->getUltimoRegistroDoFuncionario($funcionario->id);
            }
        }
        return $registroFuncionario;
    }

    public function checaSeJaBateuTodosOsPontosDoDia($registroArray) {
        if ($registroArray['primeiro_ponto'] != null && $registroArray['segundo_ponto'] != null && $registroArray['terceiro_ponto'] != null && $registroArray['quarto_ponto'] != null)
            return true;
        else
            return false;
    }

    public function store($funcionario) {
        $data = date('Y-m-d H:i:s');

        $registroFuncionario = $this->getUltimoRegistroDoFuncionario($funcionario->id);

        if ($registroFuncionario == null) {
            $registroArray = $this->createRegistroArray($funcionario);
            $registroFuncionario = $this->create($registroArray);
        }

        $registroArray = $this->createRegistroArray($funcionario);

        if ($this->checaSeORegistroFoiCriadoNoMesmoDia($registroFuncionario->created_at) == false) {
            $registroFuncionario = $this->create($registroArray);
        }

        if ($this->checaSeJaBateuTodosOsPontosDoDia($registroFuncionario))
            return "Todos os pontos já foram batidos";

        $registroFuncionario = $this->checaSeOFuncionarioEstaAtrasado($registroFuncionario, $funcionario, $data);

        $novoRegistro = $this->batePonto($funcionario, $registroFuncionario, $data);

        return $novoRegistro;
    }

    public function retornaTodoORegistroDoFuncionario(Request $request) {
          $funcionario = Funcionario::findOrFail($request->id_funcionario);
        $horario = $this->getFuncionarioHorario($funcionario->id_horario);
        $registro = Registro::where('id_funcionario', $funcionario->id)
            ->orderBy('created_at', 'desc')->get();
        $faltas = Falta::where('id_funcionario', $funcionario->id)->get();

        for ($i = 0; $i < count($registro); $i++) {
            if ($registro[$i]['primeiro_ponto'] != null)
                $registro[$i]['primeiro_ponto'] = date("H:i:s", strtotime($registro[$i]['primeiro_ponto']));
            if ($registro[$i]['segundo_ponto'] != null)
                $registro[$i]['segundo_ponto'] = date("H:i:s", strtotime($registro[$i]['segundo_ponto']));
            if ($registro[$i]['terceiro_ponto'] != null)
                $registro[$i]['terceiro_ponto'] = date("H:i:s", strtotime($registro[$i]['terceiro_ponto']));
            if ($registro[$i]['quarto_ponto'] != null)
                $registro[$i]['quarto_ponto'] = date("H:i:s", strtotime($registro[$i]['quarto_ponto']));

            $registro[$i]['data'] = date("d/m/Y", strtotime($registro[$i]['created_at']));

            if ($horario != null) {
                if ($funcionario->carga_horaria == '40h')
                    $registro[$i]['horas_trabalhadas'] = $this->calculaHorasTrabalhadas40h($horario, $registro[$i]);
                if ($funcionario->carga_horaria == '20h')
                    $registro[$i]['horas_trabalhadas'] = $this->calculaHorasTrabalhadas20h($horario, $registro[$i]);
            }

            // for ($j = 0; $j < count($faltas); $j++) {
            //     $faltas[$j]['data'] = date("d/m/Y", strtotime($faltas[$j]['data']));
            //     if ($faltas[$j]['data'] == $registro[$i]['data']) {
            //         $registro[$i]['falta'] = $faltas[$j]['id'];
            //     }
            // }
        }
        return $registro;
    }

    public function calculaHorasTrabalhadas40h($horario, $registro) {

    }

    public function calculaHorasTrabalhadas20h($horario, $registro) {

    }

    public function getFaltaDoFuncionario($id_funcionario) {
        $falta = Falta::show($id_funcionario);
        return $falta;
    }

    public function retornaOUltimoRegistroDoFuncionario(Request $request) {
        //
        $funcionario = Funcionario::where('matricula', $request->matricula)->get()->first();
        $registro = Registro::where('id_funcionario', $funcionario->id)->orderBy('created_at', 'desc')->get()->first();

        if (!$registro)
            return null;
        return $registro;
    }

    public function retornaORegistroDaDataEspecificada($funcionario, $data) {
        $registro = Registro::where('id_funcionario', $funcionario->id)->where('created_at', 'like', '%' . $data . '%')->get();
        if (count($registro) == 0)
            return null;
        return $registro;
    }

    public function cadastraFaltaNoRegistro($funcionario, $data) {
        $falta = Falta::where('id_funcionario', $funcionario->id)->where('data', 'like', '%' . $data . '%')->get();
        if (count($falta) == 0)
            return null;
        return $falta;
    }

    public function gerarRelatorioDeRegistroDoPonto(Request $request) {
        $funcionario = Funcionario::firstOrNew(['matricula' => $request->matricula]);
        if ($funcionario == null)
            return response()->json(['message' => 'Funcionário não encontrado'], 404);

        $mesAtual = date('m');
        $anoAtual = date('Y');
        $diaAtual = date('d');
        $totalDiasDoMesAtual = cal_days_in_month(CAL_GREGORIAN, $mesAtual, $anoAtual);
        $relatorio = array(
                // 'funcionario' => $funcionario,
                array(
                    'dia' => null,
                    'registroDoDia' => null,
                    'justificativa' => null
                )
        );

        for ($day = 1, $i = 0; $day <= $totalDiasDoMesAtual; $day++, $i++) {
            $data = sprintf('%02d', $day) . '/' . $mesAtual . '/' . $anoAtual;
            $dataDB = $anoAtual . '-' . $mesAtual . '-' . sprintf('%02d', $day);
            $relatorio[$i]['dia'] = $data;
            $relatorio[$i]['registroDoDia'] = $this->retornaORegistroDaDataEspecificada($funcionario, $dataDB);
            $relatorio[$i]['justificativa'] = $this->cadastraFaltaNoRegistro($funcionario, $dataDB);
        }
        $relatorioTratado = $this->tratarDadosRelatorio($relatorio);

        return $relatorioTratado;
    }

    public function tratarDadosRelatorio($relatorio) {

        for ($i = 0; $i < sizeof($relatorio); $i++) {
            if ($relatorio[$i]['justificativa'] && !$relatorio[$i]['registroDoDia']) {
                $relatorio[$i]['registroDoDia'] = array(
                    'primeiro_ponto' => 'JUSTIFICADO',
                    'segundo_ponto' => 'JUSTIFICADO',
                    'terceiro_ponto' => 'JUSTIFICADO',
                    'quarto_ponto' => 'JUSTIFICADO',
                    'atrasou_primeiro_ponto' => false,
                    'atrasou_segundo_ponto' => false,
                    'atrasou_terceiro_ponto' => false,
                    'atrasou_quarto_ponto' => false
                );
                // pegar o range da data da justificativa e preencher, tambem ver os casos das justificativas de meio periodo
            }
            if ($relatorio[$i]['justificativa'] && $relatorio[$i]['registroDoDia']) {
                if (!isset($relatorio[$i]['registroDoDia'][0]['primeiro_ponto'])) {
                    $relatorio[$i]['registroDoDia'][0]['primeiro_ponto'] = 'JUSTIFICADO';
                }
                if (!isset($relatorio[$i]['registroDoDia'][0]['segundo_ponto'])) {
                    $relatorio[$i]['registroDoDia'][0]['segundo_ponto'] = 'JUSTIFICADO';
                }
                if (!isset($relatorio[$i]['registroDoDia'][0]['terceiro_ponto'])) {
                    $relatorio[$i]['registroDoDia'][0]['terceiro_ponto'] = 'JUSTIFICADO';
                }
                if (!isset($relatorio[$i]['registroDoDia'][0]['quarto_ponto'])) {
                    $relatorio[$i]['registroDoDia'][0]['quarto_ponto'] = 'JUSTIFICADO';
                }
            }
        }
        return $relatorio;
    }
}
