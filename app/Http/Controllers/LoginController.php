<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function store(Request $request){
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'password.required' => 'O campo "senha" é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ]);

        if (!Auth::attempt($login)) {
            return redirect()->back()->withErrors([
                'email' => 'Usuário ou senha inválido.',
            ])->withInput();
        }
        $user = Auth::user();
        $username = $user->name;

        return to_route('series.home')->with('success', "Bem-vindo, $username!")->with('user', Auth::user());
    }

    public function destroy(){
        Auth::logout();

        return to_route('login');
    }
}
