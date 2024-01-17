<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\LoginController;

class AuthController extends Controller
{
	public function login(Request $request)
	{
		$request->validate([
			'matricula' => 'required',
			'data_nascimento' => 'required',
			'device_name' => 'required',
		]);

		$funcionario = Funcionario::where('matricula', $request->matricula)->first();

		if (!$funcionario) {
			throw ValidationException::withMessages([
				'email' => ['Dados incorretos'],
			]);
		} else {
			$login = new LoginController();
			$login = $login->criarTabelaRegistro($request);
			$token = $funcionario->createToken($request->device_name)->plainTextToken;
			return response()->json([
				'funcionario' => $funcionario,
				'registro' => $login,
				'access_token' => $token,
			]);
		}
	}
}
