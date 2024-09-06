<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Funcionario;
use App\Models\Falta;
use App\Models\Justificativa;

class RegistroController extends Controller
{

    public function converterDiaDaSemanaParaPortugues($diaDaSemana)
    {
        switch ($diaDaSemana) {
            case 'Sunday':
                return 'Domingo';
            case 'Monday':
                return 'Segunda-feira';
            case 'Tuesday':
                return 'Terça-feira';
            case 'Wednesday':
                return 'Quarta-feira';
            case 'Thursday':
                return 'Quinta-feira';
            case 'Friday':
                return 'Sexta-feira';
            case 'Saturday':
                return 'Sábado';
        }
    }

    public function tratarDadosRelatorio($funcionario, $relatorio)
    {
        $relatorio = $this->inserirJustificativaNoRelatorio($relatorio);

        for ($i = 0; $i < sizeof($relatorio); $i++) {
            // se a data for um sábado ou domingo, o registro do dia é nulo
            $data = explode('/', $relatorio[$i]['dia']);
            $diaDaSemana = date('w', strtotime($data[2] . '-' . $data[1] . '-' . $data[0]));
            if ($diaDaSemana == 0 || $diaDaSemana == 6) {
                $relatorio[$i]['registroDoDia'] = [array(
                    'primeiro_ponto' => '-',
                    'segundo_ponto' => '-',
                    'terceiro_ponto' => '-',
                    'quarto_ponto' => '-',
                    'atrasou_primeiro_ponto' => false,
                    'atrasou_segundo_ponto' => false,
                    'atrasou_terceiro_ponto' => false,
                    'atrasou_quarto_ponto' => false
                )];
            }

            // se o ponto for nulo, substituir por 'Sem Registro'
            if ($relatorio[$i]['registroDoDia'][0]['primeiro_ponto'] == null)
                $relatorio[$i]['registroDoDia'][0]['primeiro_ponto'] = 'Sem Registro';
            if ($relatorio[$i]['registroDoDia'][0]['segundo_ponto'] == null)
                $relatorio[$i]['registroDoDia'][0]['segundo_ponto'] = 'Sem Registro';
            if ($relatorio[$i]['registroDoDia'][0]['terceiro_ponto'] == null)
                $relatorio[$i]['registroDoDia'][0]['terceiro_ponto'] = 'Sem Registro';
            if ($relatorio[$i]['registroDoDia'][0]['quarto_ponto'] == null)
                $relatorio[$i]['registroDoDia'][0]['quarto_ponto'] = 'Sem Registro';


            if ($relatorio[$i]['falta'] !== null) {
                if (!$relatorio[$i]['falta'][0]['data2'])
                    $relatorio[$i]['falta'][0]['data2'] = $relatorio[$i]['falta'][0]['data'];
                $dataInicio = explode('-', $relatorio[$i]['falta'][0]['data']);
                $dataFim = explode('-', $relatorio[$i]['falta'][0]['data2']);
                $justificativa = $relatorio[$i]['justificativa'];
                for ($j = $dataInicio[2]; $j <= $dataFim[2]; $j++) {
                    // se a data for um fim de semana, o registro do dia é nulo
                    $diaDaSemana = date('w', strtotime($dataInicio[0] . '-' . $dataInicio[1] . '-' . $j));
                    if ($relatorio[$j - 1]['justificativa'] == null) {
                        $relatorio[$j - 1]['justificativa'] = $justificativa;
                    }
                    if ($diaDaSemana == 0 || $diaDaSemana == 6) {
                        $relatorio[$j - 1]['registroDoDia'] = [array(
                            'primeiro_ponto' => '-',
                            'segundo_ponto' => '-',
                            'terceiro_ponto' => '-',
                            'quarto_ponto' => '-',
                            'atrasou_primeiro_ponto' => false,
                            'atrasou_segundo_ponto' => false,
                            'atrasou_terceiro_ponto' => false,
                            'atrasou_quarto_ponto' => false
                        )];
                    } else {
                        if ($relatorio[$j - 1]['falta'][0]->primeiro_turno == true) {
                            $relatorio[$j - 1]['registroDoDia'][0]['primeiro_ponto'] = 'JUSTIFICADO';
                        }
                        if ($relatorio[$j - 1]['falta'][0]->segundo_turno == true)
                        {
                            $relatorio[$j - 1]['registroDoDia'][0]['segundo_ponto'] = 'JUSTIFICADO';
                        }
                        if ($relatorio[$j - 1]['falta'][0]->terceiro_turno == true) {
                            $relatorio[$j - 1]['registroDoDia'][0]['terceiro_ponto'] = 'JUSTIFICADO';
                        }
                        if ($relatorio[$j - 1]['falta'][0]->quarto_turno == true)
                        {
                            $relatorio[$j - 1]['registroDoDia'][0]['quarto_ponto'] = 'JUSTIFICADO';
                        }
                    }
                }
            }
        }
        return $relatorio;
    }

    public function inserirJustificativaNoRelatorio($relatorio)
    {
        for ($i = 0; $i < sizeof($relatorio); $i++) {
            if ($relatorio[$i]['justificativa']) {
                $justificativa = Justificativa::where('id', $relatorio[$i]['justificativa'][0]['id_justificativa'])->get();
                $relatorio[$i]['justificativa'] = $justificativa[0]->justificativa;
            }
        }
        return $relatorio;
    }

    public function cadastraFaltaNoRegistro($funcionario, $data)
    {
        $falta = Falta::where('id_funcionario', $funcionario->id)->where('data', 'like', '%' . $data . '%')->get();
        if (count($falta) == 0)
            return null;
        return $falta;
    }

    public function trataORegistroAntigoParaORelatorio($registro)
    {
        if ($registro == null)
            return null;

        // Tratamento para os registros antigos que eram salvos como timestamp
        if (strlen($registro[0]['primeiro_ponto']) == 19) {
            $registro[0]['primeiro_ponto'] = explode(' ', $registro[0]['primeiro_ponto'])[1];
        }
        if (strlen($registro[0]['segundo_ponto']) == 19) {
            $registro[0]['segundo_ponto'] = explode(' ', $registro[0]['segundo_ponto'])[1];
        }
        if (strlen($registro[0]['terceiro_ponto']) == 19) {
            $registro[0]['terceiro_ponto'] = explode(' ', $registro[0]['terceiro_ponto'])[1];
        }
        if (strlen($registro[0]['quarto_ponto']) == 19) {
            $registro[0]['quarto_ponto'] = explode(' ', $registro[0]['quarto_ponto'])[1];
        }
        return $registro;
    }

    public function retornaORegistroDaDataEspecificada($funcionario, $data, $day)
    {
        // retornar o registro do dia especifico
        $registro = Registro::where('id_funcionario', $funcionario->id)->whereMonth('created_at', date('m', strtotime($data)))->whereYear('created_at', date('Y', strtotime($data)))->whereDay('created_at', date('d', strtotime($data)))->get();

        $registroNull = array(
            'primeiro_ponto' => 'Sem Registro',
            'segundo_ponto' => 'Sem Registro',
            'terceiro_ponto' => 'Sem Registro',
            'quarto_ponto' => 'Sem Registro',
        );

        if (count($registro) == 0) {
            return [$registroNull];
        }
        return $registro;
    }

    public function tratarMesSelecionado($mesSelecionado)
    {
        if ($mesSelecionado != '10' || $mesSelecionado != '11' || $mesSelecionado != '12') {
            $mesSelecionado = '0' . $mesSelecionado;
        }

        return $mesSelecionado;
    }

    public function retornaAFaltaDoDiaDoFuncionario($funcionario, $data)
    {
        $falta = Falta::where('id_funcionario', $funcionario->id)->where('data', 'like', '%' . $data . '%')->get();

        if (count($falta) == 0) {
            $falta = Falta::where('id_funcionario', $funcionario->id)->where('data2', 'like', '%' . $data . '%')->get();
            if (count($falta) == 0)
                return null;
        }
        return $falta;
    }

    /**
     * Gera o relatório de registro do ponto.
     */
    public function gerarRelatorioDeRegistroDoPonto(Request $request)
    {
        $funcionario = Funcionario::firstOrNew(['matricula' => $request->matricula]);
        if ($funcionario == null)
            return response()->json(['message' => 'Funcionário não encontrado'], 404);

        $mesSelecionado = $request->data;
        if ($mesSelecionado)
            $mesDoRegistro = $this->tratarMesSelecionado($mesSelecionado);
        else
            return response()->json(['message' => 'Data não informada'], 404);

        $anoAtual = date('Y');
        $totalDiasDoMesAtual = cal_days_in_month(CAL_GREGORIAN, $mesSelecionado, $anoAtual);

        $relatorio = array();
        for ($day = 1, $i = 0; $day <= $totalDiasDoMesAtual; $day++, $i++) {
            $data = sprintf('%02d', $day) . '/' . $mesDoRegistro . '/' . $anoAtual;
            $dataDB = $anoAtual . '-' . $mesDoRegistro . '-' . sprintf('%02d', $day);

            $diaSemana = date('l', strtotime($dataDB));
            $diaSemana = $this->converterDiaDaSemanaParaPortugues($diaSemana);
            $relatorio[$i]['dia'] = $data;
            $relatorio[$i]['diaSemana'] = $diaSemana;

            $registro = $this->retornaORegistroDaDataEspecificada($funcionario, $dataDB, $day);
            $relatorio[$i]['registroDoDia'] = $this->trataORegistroAntigoParaORelatorio($registro);

            // buscar as faltas do funcionário
            $relatorio[$i]['falta'] = $this->retornaAFaltaDoDiaDoFuncionario($funcionario, $dataDB);

            $relatorio[$i]['justificativa'] = $this->cadastraFaltaNoRegistro($funcionario, $dataDB);
        }
        // return $relatorio;
        $relatorioTratado = $this->tratarDadosRelatorio($funcionario, $relatorio);

        return $relatorioTratado;
    }

    /**
     * Retorna o último registro do funcionário.
     */
    public function retornaOUltimoRegistroDoFuncionario($funcionario)
    {
        $registro = Registro::where('id_funcionario', $funcionario->id)->latest()->first();

        return $registro;
    }

    public function converteTimestampParaHoraConvencional($registro)
    {
        for ($i = 0; $i < count($registro); $i++) {
            if ($registro[$i]['primeiro_ponto'] != null && $registro[$i]['primeiro_ponto'] != 'FALTA' && $registro[$i]['primeiro_ponto'] != 'JUSTIFICATIVA' && $registro[$i]['primeiro_ponto'] != 'JUSTIFICADO' && $registro[$i]['primeiro_ponto'] != 'ATRASADO' && $registro[$i]['primeiro_ponto'] != 'Sem Registro')
                $registro[$i]['primeiro_ponto'] = date("H:i:s", strtotime($registro[$i]['primeiro_ponto']));
            if ($registro[$i]['segundo_ponto'] != null && $registro[$i]['segundo_ponto'] != 'FALTA' && $registro[$i]['segundo_ponto'] != 'JUSTIFICATIVA' && $registro[$i]['segundo_ponto'] != 'JUSTIFICADO' && $registro[$i]['segundo_ponto'] != 'ATRASADO' && $registro[$i]['segundo_ponto'] != 'Sem Registro')
                $registro[$i]['segundo_ponto'] = date("H:i:s", strtotime($registro[$i]['segundo_ponto']));
            if ($registro[$i]['terceiro_ponto'] != null && $registro[$i]['terceiro_ponto'] != 'FALTA' && $registro[$i]['terceiro_ponto'] != 'JUSTIFICATIVA' && $registro[$i]['terceiro_ponto'] != 'JUSTIFICADO' && $registro[$i]['terceiro_ponto'] != 'ATRASADO' && $registro[$i]['terceiro_ponto'] != 'Sem Registro')
                $registro[$i]['terceiro_ponto'] = date("H:i:s", strtotime($registro[$i]['terceiro_ponto']));
            if ($registro[$i]['quarto_ponto'] != null && $registro[$i]['quarto_ponto'] != 'FALTA' && $registro[$i]['quarto_ponto'] != 'JUSTIFICATIVA' && $registro[$i]['quarto_ponto'] != 'JUSTIFICADO' && $registro[$i]['quarto_ponto'] != 'ATRASADO' && $registro[$i]['quarto_ponto'] != 'Sem Registro')
                $registro[$i]['quarto_ponto'] = date("H:i:s", strtotime($registro[$i]['quarto_ponto']));
        }

        return $registro;
    }

    /**
     * Retorna todo o registro do funcionário.
     */
    public function retornaTodoORegistroDoFuncionario(Request $request)
    {
        $funcionario = Funcionario::findOrFail($request->id_funcionario);
        $registro = Registro::where('id_funcionario', $funcionario->id)
            ->orderBy('created_at', 'desc')->get();

        $registro = $this->converteTimestampParaHoraConvencional($registro);

        for ($i = 0; $i < count($registro); $i++) {

            $registro[$i]['data'] = date("d/m/Y", strtotime($registro[$i]['created_at']));
            $registro[$i]['justificativa'] = $this->cadastraFaltaNoRegistro($funcionario, date("Y-m-d", strtotime($registro[$i]['created_at'])));
        }

        $registro = $this->inserirJustificativaNoRelatorio($registro);

        return $registro;
    }
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
