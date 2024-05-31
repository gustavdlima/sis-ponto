<?php

namespace App\Http\Controllers;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CargoController extends Controller
{

    public function index()
    {
        $cargos = DB::select('select * from cargos');
        return $cargos;
    }

    public function create(Request $request)
    {
        $cargo = new Cargo;
        $cargo->cargo = $request->cargo;
        $cargo->save();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cargo' => 'required|string|max:255',
        ]);

        $cargo = Cargo::firstOrNew(['cargo' => $request->cargo]);
        if ($cargo['id'] == null) {
            $cargo = Cargo::create($request->all());
            return response()->json(['message' => 'Cargo criado.'], 201);
        } else {
            return response()->json(['message' => 'Erro ao criar cargo.'], 400);
        }
    }

    public function show($id)
    {
        $cargo = DB::select('select * from cargos where id = ?', [$id]);
        return $cargo;
    }
}
