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
        // return $request->all();
        // $validated = $request->validate([
        //     'nome' => 'required|string|max:255',
        //     'setor' => 'required|string',
        //     'matricula' => 'required|string',
        //     'data_nascimento' => 'required|date',
        //     'rg' => 'required|string',
        //     'cpf' => 'required|string',
        //     'pis_pasep' => 'required|string',
        //     'titulo_eleitor' => 'required|string',
        //     'mae' => 'required|string|max:255',
        //     'bairro' => 'required|string|max:255',
        //     'rua' => 'required|string|max:255',
        //     'numero' => 'required|string|max:255',
        //     'cidade' => 'required|string|max:255',
        //     'uf' => 'required|string|max:255',
        //     'cep' => 'required|string|max:255',
        //     'estado_civil' => 'required|string|max:255',
        //     'celular' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255',
        //     'carga_horaria' => 'required|string|max:255',
        // ]);

        $funcionario = Funcionario::firstOrNew(['matricula' => $request->matricula]);
        if ($funcionario['id'] == null) {
            $funcionario = Funcionario::create($request->all());
            return response()->json([
                'message' => 'Funcionário cadastrado com sucesso!',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Funcionário já cadastrado!',
            ], 200);
        }
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
    public function update(Request $request)
    {
        $funcionario = Funcionario::findOrFail($request->id);
        $funcionario->update($request->all());
        $funcionario->save();
        return response()->json([
            'message' => 'Funcionário atualizado com sucesso!',
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $funcionario = Funcionario::findOrFail($request->id);
        $funcionario->delete();
        return response()->json([
            'message' => 'Funcionário deletado com sucesso!',
        ], 200);
    }
}
