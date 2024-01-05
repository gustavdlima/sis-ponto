<?php

namespace App\Http\Controllers;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function getArrayOfCargoValues() {
        $cargos = DB::table('cargos')->pluck('cargo');
        return $cargos;
    }

    public function index()
    {
        return $this->getArrayOfCargoValues();
    }

    public function store(Request $request)
    {
        $cargo = new Cargo;
        $cargo->cargo = $request->cargo;
        $cargo->save();
        return $cargo;
    }

    public function show($id)
    {
        $cargo = DB::select('select * from cargos where id = ?', [$id]);
        return $cargo;
    }
}
