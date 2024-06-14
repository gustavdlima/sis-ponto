<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::select('select * from users');
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($data)
    {
        $user = User::create($data);
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level' => 'required|string',
        ]);

        $user = User::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level
        ]);
        if ($user->wasRecentlyCreated === true) {
            return response()->json([
                'message' => 'Operador cadastrado com sucesso!',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Operador já cadastrado!',
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = DB::select('select * from users where id = ?', [$id]);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->update($request->all());
        $user->save();
        return response()->json([
            'message' => 'Operador atualizado com sucesso!',
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
    }
}
