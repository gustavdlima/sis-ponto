<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->listarUsuarios();
    }

    public function store(UserRequest $request)
    {
        return $this->userService->criarUsuario($request->all());
    }

    public function show($id)
    {
        return $this->userService->procurarUsuarioPeloId($id);
    }

    public function update(UserRequest $request, $id)
    {
        return $this->userService->atualizarUsuario($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->userService->excluirUsuario($id);
    }
}
