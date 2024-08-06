<x-login-layout title="SeriesHub - Login">

    <h1 class="titulo">BEM VINDO AO SEU SITE DAS SÉRIES</h1>
    
    <div id="login">
        <div class="caixa">         
            <h1 style="color: pink;">LOGIN</h1>

            <form action="{{ route('signin')}}" method="post">
                @csrf
                <div class="email">
                    <input type="email" name="email" id="email" placeholder="E-mail" value="{{ old('email') }}" required>
                </div>

                <div class="senha" style="padding-bottom: 20px;">
                    <input type="password" name="password" id="password" placeholder="Senha" required>
                </div>

                <div class="entrar">
                    <p>Ainda não tem uma conta? <a href="{{ route('users.create')}}">Cadastre-se agora!</a></p>
                    <button type="submit" class="btn btn-success" style="text-decoration: none; color: white; font-weight: bold; background-color: green; color: white; border: none; width: 160px;">
                        <i class="fa-solid fa-right-to-bracket"></i> Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-login-layout>