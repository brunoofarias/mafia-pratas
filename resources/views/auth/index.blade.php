@extends('layout')

@section('content')
    <div class="content">
        <div class="login-container">
            <h4>Faça o Login</h4>
            <form class="form" action="/admin/login" method="post">
                @csrf
                @if (isset($error))
                    <p>{{ $error }}</p>
                @endif
                <div class="">
                    <label class="sr-only" for="email">Username</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="">
                    <label class="sr-only" for="password">Username</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Senha">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Acessar</button>

            </form>
            <a href="#">Esqueci minha senha</a>
        </div>
    </div>
@endsection
