<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\HorarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('/funcionarios', FuncionarioController::class)->only(['index', 'create', 'store', 'show', 'update', 'destroy']);

Route::resource('/cargos', CargoController::class)->only(['index', 'create', 'show', 'store']);

Route::resource('/horarios', HorarioController::class)->only(['index', 'create', 'show', 'store', 'update', 'destroy']);

// Route::get('/cargo', CargoController::class, 'index');
// Route::post('/cargo', CargoController::class, 'create');
// Route::get('/cargo/{$id}', CargoController::class, 'show');

Route::post('/login', [LoginController::class, 'criarTabelaRegistro']);

Route::post('/cadastro', [CadastroController::class, 'store']);
