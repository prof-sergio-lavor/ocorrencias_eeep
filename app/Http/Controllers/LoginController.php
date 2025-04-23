<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Usuario;

class LoginController extends Controller
{
    // Mostrar tela de login
    public function showLogin()
    {
        return view('login');
    }

    // Processar login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required']
        ]);

        $usuario = Usuario::where('email', $credentials['email'])->first();

        if ($usuario && Hash::check($credentials['senha'], $usuario->senha)) {
            Session::put('usuario_id', $usuario->id);
            Session::put('usuario_nome', $usuario->nome);
            Session::put('usuario_tipo', $usuario->tipo);

            return redirect()->route('painel', ['tipo' => $usuario->tipo]);
        }

        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos.'
        ]);
    }

    // Fazer logout
    public function logout()
    {
        Session::flush();
        return redirect()->route('login.form'); // ✅ CORRIGIDO
    }
}
