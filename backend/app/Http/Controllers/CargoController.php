<?php

namespace App\Http\Controllers;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function getJustCargoColumn() {
        $cargos = DB::select('select cargo from cargos');
        return json_decode($cargos, true);
    }

    public function index()
    {
        // $cargos = DB::select('select * from cargos');
        return $this->getJustCargoColumn();
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
