<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $user = Usuario::where('email', $request->email)->first();

        if ($user && $request->senha === $user->senha) {
            Auth::login($user);
            return redirect('/pedido');
        } else {
            return back()->withErrors(['email' => 'E-mail ou senha inválidos']);
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
