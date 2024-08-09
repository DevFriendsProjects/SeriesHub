<x-login-layout title="SeriesHub - Cadastrar">

    <div id="login">
        <div class="caixa"> 

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 style="color: pink">CADASTRO</h1>

            <form action="{{ route('users.store')}}" method="post">
            @csrf
            <div class="name">
                <input type="text" name="name" id="name" placeholder="Nome" value="{{ old('name') }}" required>
            </div>

            <div class="email">
                <input type="email" name="email" id="email" placeholder="E-mail" value="{{ old('email') }}" required>
            </div>

            <div class="senha">
                <input type="password" name="password" id="password" placeholder="Senha" required>
            </div>

            <div class="senha">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme a sua senha" required>
            </div>
            <button type="submit" class="btn btn-success mt-3" style="text-decoration: none; color: white; font-weight: bold; background-color: green; color: white; border: none; width: 160px;">
                <i class="fa-solid fa-right-to-bracket"></i> Cadastrar
            </button>
            </form>
            <p class="mt-2">Já tem uma conta? <a href="{{ route('login')}}">Entre aqui.</a></p>
        </div>
    </div>
</x-login-layout>