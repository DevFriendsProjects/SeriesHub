<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function create(){
        return view('users.create');
    }

    public function store(AddUsersRequest $request){
        $user = $request->validated();
        $user['password'] = Hash::make($user['password']);

        User::create($user);

        return to_route('login')->with('success', 'Cadastro realizado com sucesso!');
    }
}
