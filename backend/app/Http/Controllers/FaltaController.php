<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Falta;
use App\Models\Registro;
use DateTime;
date_default_timezone_set('America/Sao_Paulo');

class FaltaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faltas = DB::select('select * from faltas');
        return $faltas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $falta = new Falta;
        $falta->id_justificativa = $request->id_justificativa;
        $falta->id_funcionario = $request->id_funcionario;
        $falta->data = $request->data;
        $falta->data2 = $request->data2;
        $falta->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_justificativa' => 'required',
            'id_funcionario' => 'required',
            'data' => 'required',
            'data2' => 'required',
        ]);

        $falta = DB::table('faltas')
                ->select('data')
                ->where('id_funcionario', $request->id_funcionario)
                ->where('data', $request->data)
                ->get();

        if ($falta->count() <= 0) {
            $falta = $this->create($request);
            return "Falta registrada com sucesso";
        } else {
            return "Falta ja registrada";
        }

        return $falta;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $falta = DB::select('select * from faltas where id_funcionario = ?', [$id]);
        return $falta;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
