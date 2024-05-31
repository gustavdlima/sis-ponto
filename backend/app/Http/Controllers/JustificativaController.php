<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Justificativa;

class JustificativaController extends Controller
{
    public function index()
    {
        $justificativa = DB::select('select * from justificativas');
        return $justificativa;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'justificativa' => 'required|string|max:255',
        ]);

        $justificativa = Justificativa::firstOrNew(['justificativa' => $request->justificativa]);
        if ($justificativa['id'] == null) {
            $justificativa = new Justificativa;
            $justificativa->justificativa = $request->justificativa;
            $justificativa->save();
            return response()->json(['message' => 'Justificativa criada.'], 201);
        } else {
            return response()->json(['message'=> 'Erro ao criar justificativa'],200);
        }
    }

    public function show($id)
    {
        $justificativa = DB::select('select * from justificativas where id = ?', [$id]);
        return $justificativa;
    }

}
