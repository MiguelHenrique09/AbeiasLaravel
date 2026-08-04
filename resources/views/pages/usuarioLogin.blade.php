@extends('layouts.app')

@section('title', 'Login — Abeias Burguer')

@section('content')

<style>
    .login-area {
        background: #06092a;
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .card-login {
        margin-top: 150px;
        background: #06092a;
        padding: 35px;
        width: 100%;
    }

    .form-control,
    .form-select {
        height: 55px;
        font-size: 18px;
    }

    .btn-login {
        height: 55px;
        font-size: 18px;
        font-weight: bold;
    }
</style>

<div class="container bg-dark py-4">
<div class="container-fluid login-area">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card-login">

                {{-- Erros de validação (ex: credenciais inválidas) --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="text-white mb-2">E-mail</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Digite seu e-mail">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="text-white mb-2">Senha</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Digite sua senha">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100 btn-login">
                            Login
                        </button>
                    </div>

                </form>

                <div class="mt-4">
                    <a href="{{ route('usuarioCadastro') }}" class="btn btn-primary w-100 btn-login">
                        Cadastre-se
                    </a>
                </div>

            </div>

        </div>
    </div>
    <a href="{{ route('home') }}" class="btn btn-light fw-bold">
        Voltar
    </a>
</div>

</div>
@endsection