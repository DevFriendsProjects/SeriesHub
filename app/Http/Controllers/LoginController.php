<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Função para exibir a página de login ou redireciona para a home se o usuário já estiver logado
    public function index(){ 
        if (Auth::check()) { // Verifica se o usuário está logado
            $user = Auth::user(); // Armazena o usuário logado
            Auth::login($user); // Garante que o usuário esteja autenticado
            $username = $user->name; // Armezena o nome do usuário

            // Redireciona para a página inicial com uma mensagem de boas-vindas
            return to_route('series.home')->with('success', "Bem-vindo, $username!")->with('user', $user);
        } else {
            // Se o usuário não estiver autenticado, exibe a página de login
            return view('login.index');
        }
    }

    // Função para o usuário autenticar e logar no sistema
    public function store(Request $request){
        // Valida os campos de e-mail e senha recebidos do formulário login
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'password.required' => 'O campo "senha" é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ]);

        // Tenta autenticar o usuário com as credenciais fornecidas
        if (!Auth::attempt($login)) {
            // Se a autenticação falhar, redireciona de volta com um erro
            return redirect()->back()->withErrors([
                'email' => 'Usuário ou senha inválido.',
            ])->withInput();
        }

        // Se a autenticação for bem-sucedida, armazena o usuário e envia o usuário para o home
        $user = Auth::user();
        $username = $user->name;

        return to_route('series.home')->with('success', "Bem-vindo, $username!")->with('user', $user);
    }

    // Função para fazer o logout do usuário
    public function destroy(){
        Auth::logout(); // Desconecta o usuário

        // Redireciona para a página de login após o logout
        return to_route('login');
    }
}