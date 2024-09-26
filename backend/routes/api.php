<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PontoController, FuncionarioController, CargoController,
    HorarioController, UserController, LoginController, RegistroController,
    JustificativaController, FaltaController, DiasDaSemanaController
};

// Rotas protegidas pelo middleware 'auth:sanctum'
Route::middleware('auth:sanctum')->group(function () {
    // Rotas RESTful para CRUD
    Route::resource('/funcionarios', FuncionarioController::class);
    Route::resource('/cargos', CargoController::class);
    Route::resource('/justificativas', JustificativaController::class);
    Route::resource('/horarios', HorarioController::class);
    Route::resource('/faltas', FaltaController::class);
    Route::resource('/diaDaSemana', DiasDaSemanaController::class);

    // Rotas para funções específicas
    Route::get('/faltasFuncionario', [FaltaController::class, 'faltasFuncionario']);
    Route::post('/registroFuncionario', [RegistroController::class, 'retornaTodoORegistroDoFuncionario']);
    Route::post('/registroDoDia', [PontoController::class, 'retornaRegistroDoDia']);
    Route::post('/relatorio', [RegistroController::class, 'gerarRelatorioDeRegistroDoPonto']);

    // Rota para obter o usuário autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout
    Route::post('/logout', [LoginController::class, 'logout']);
});

// Rotas públicas (login, ponto)
Route::post('/ponto', [PontoController::class, 'registrarPonto']);
Route::post('/login', [LoginController::class, 'authenticate']);

// Rotas de usuários (sem middleware para facilitar registro ou ações públicas)
Route::resource('/users', UserController::class);
