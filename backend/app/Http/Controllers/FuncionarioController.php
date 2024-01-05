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
    public function create($input)
    {
        $data = json_decode($input, true);
        $id = Funcionario::create($data);
        return $id;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = json_decode($request, true);
        // $id = Funcionario::create($data);
        // return $id;
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
    public function edit(Funcionario $funcionario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario)
    {
        //
    }
}
