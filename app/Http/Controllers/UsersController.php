<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Função para exibir o formulário de criação de usuário ou redireciona para home caso o usuário já estiver autenticado
    public function create(){
        if (Auth::check()) { // Checa se já existe um usuário logado
            $user = Auth::user(); // Pega o usuário logado da sessão atual
            Auth::login($user); // Revalida o login do usuário logado
            $username = $user->name; // Captura o nome do usuário logado

            // Redireciona para a home das séries com uma mensagem de boas-vindas, com o usuário e seu username
            return to_route('series.home')->with('success', "Bem-vindo, $username!")->with('user', $user);
        } else {
            // Se o usuário não estiver autenticado, exibe a página de criação de usuário
            return view('users.create');
        }
    }

    // Função para salvar um novo usuário no banco de dados
    public function store(AddUsersRequest $request){
        // Valida os dados enviados do formulário de cadastro
        $user = $request->validated();

        // Faz o hash da senha para armazenamento seguro no banco de dados
        $user['password'] = Hash::make($user['password']);

        // Cria um novo registro de usuário no banco de dados
        User::create($user);

        // Redireciona o usuário para a página de login com uma mensagem de sucesso
        return to_route('login')->with('success', 'Cadastro realizado com sucesso!');
    }
}