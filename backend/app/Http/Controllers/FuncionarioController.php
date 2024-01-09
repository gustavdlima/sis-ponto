<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::select('select * from funcionarios');
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($data)
    {
        $funcionario = Funcionario::create($data);
        return $funcionario;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'setor' => 'required|string',
            'nivel' => 'required|string',
            'matricula' => 'required|string',
            'data_nascimento' => 'required|date',
            'rg' => 'required|string',
            'cpf' => 'required|string',
            'pis_pasep' => 'required|string',
            'titulo_eleitor' => 'required|string',
            'mae' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'estado_civil' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $funcionario = Funcionario::firstOrNew(['matricula' => $request->matricula]);
        if ($funcionario['id'] == null) {
            $funcionario = Funcionario::create($request->all());
            return "Funcionário criado com sucesso.";
        } else {
            return "Funcionário existente.";
        }

        return $funcionario;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = DB::select('select * from funcionarios where id = ?', [$id]);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return redirect()->route('funcionarios.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'setor' => 'required|string',
            'nivel' => 'required|string',
            'matricula' => 'required|string',
            'data_nascimento' => 'required|date',
            'rg' => 'required|string',
            'cpf' => 'required|string',
            'pis_pasep' => 'required|string',
            'titulo_eleitor' => 'required|string',
            'cartao_sus' => 'string',
            'mae' => 'required|string|max:255',
            'pai' => 'string|max:255',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'estado_civil' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'id_cargo' => 'string|max:255',
            'id_horario' => 'string|max:255',
        ]);

        $funcionario->update($validated);

        return redirect()->route('funcionarios.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return redirect()->route('funcionarios.index');
    }
}
