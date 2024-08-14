<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PontoController;
use App\Http\Controllers\CadastroFuncionarioController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\JustificativaController;
use App\Http\Controllers\FaltaController;
use App\Http\Controllers\DiasDaSemanaController;

/*
|--------------------------------------------------------------------------
| API Routes
|-------------------------------------4-------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/funcionarios', FuncionarioController::class)->middleware('auth:sanctum');

Route::resource('/cargos', CargoController::class)->middleware('auth:sanctum');

Route::resource('/justificativas', JustificativaController::class)->middleware('auth:sanctum');

Route::resource('/horarios', HorarioController::class)->middleware('auth:sanctum');

Route::resource('/faltas', FaltaController::class)->only(['index', 'create', 'show', 'store', 'update'])->middleware('auth:sanctum');

Route::resource('/diaDaSemana', DiasDaSemanaController::class)->middleware('auth:sanctum');

Route::post('/ponto', [PontoController::class, 'registrarPonto']);

Route::get('/faltasFuncionario', [FaltaController::class, 'retornaFaltasDoFuncionario'])->middleware('auth:sanctum');

Route::post('/registroFuncionario', [RegistroController::class, 'retornaTodoORegistroDoFuncionario'])->middleware('auth:sanctum');

Route::post('/registroDoDia', [PontoController::class, 'retornaRegistroDoDia']);

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);

Route::post('/users', [UserController::class, 'store']);

Route::post('/relatorio', [RegistroController::class, 'gerarRelatorioDeRegistroDoPonto'])->middleware('auth:sanctum');
