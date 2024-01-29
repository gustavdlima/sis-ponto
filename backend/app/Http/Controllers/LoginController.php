<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Registro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
 /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('token');
            $authUser = Auth::user();
            return response()->json([
                'token' => $token->plainTextToken,
                'authUser' => $authUser
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
