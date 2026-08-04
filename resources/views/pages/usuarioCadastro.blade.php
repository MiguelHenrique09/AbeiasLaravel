@extends('layouts.app')

@section('title', 'Cadastro — Abeias Burguer')

@section('content')

    <style>
        .register-area {
            background: #06092a;
            padding-top: 40px;
            padding-bottom: 40px;
            min-height: 100vh;
        }

        .card-register {
            margin-top: 80px;
            background: #06092a;
            padding: 35px;
            width: 100%;
        }

        .card-register .section-title {
            color: #ffffff;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .card-register .section-subtitle {
            color: #8b8fa8;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .form-control,
        .form-select {
            height: 55px;
            font-size: 17px;
            background-color: #0e1240;
            border: 1px solid #1e2460;
            color: #ffffff;
            border-radius: 8px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #0e1240;
            border-color: #4a6cf7;
            color: #ffffff;
            box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.2);
        }

        .form-control::placeholder {
            color: #4a4e6a;
        }

        .form-select option {
            background-color: #0e1240;
            color: #ffffff;
        }

        .form-label {
            color: #ffffff;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .form-text {
            color: #8b8fa8;
            font-size: 12px;
            margin-top: 5px;
        }

        .btn-register {
            height: 55px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            background-color: #4a6cf7;
            border: none;
            transition: background-color 0.2s, transform 0.1s;
        }

        .btn-register:hover {
            background-color: #3a5ce6;
            transform: translateY(-1px);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-outline-secondary-custom {
            height: 55px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            background-color: transparent;
            border: 1px solid #1e2460;
            color: #8b8fa8;
            transition: border-color 0.2s, color 0.2s;
        }

        .btn-outline-secondary-custom:hover {
            border-color: #4a6cf7;
            color: #ffffff;
        }

        .divider {
            border-color: #1e2460;
            margin: 28px 0;
        }

        .login-link {
            color: #8b8fa8;
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #4a6cf7;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #4a4e6a;
            cursor: pointer;
            padding: 0;
            font-size: 18px;
            line-height: 1;
            z-index: 5;
        }

        .password-toggle:hover {
            color: #8b8fa8;
        }

        /* Força o campo de senha a não mostrar olhinho nativo */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-webkit-contacts-auto-fill-button {
            display: none;
        }

        .alert-error {
            background-color: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.4);
            color: #ff7b87;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: #1e2460;
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            border-radius: 2px;
            width: 0%;
            transition: width 0.3s, background-color 0.3s;
        }
    </style>

    </div>
    <div class="container bg-dark py-4">
        <div class="container-fluid register-area">

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-6">

                    <div class="card-register">

    <h2 class="text-white mb-2">Criar conta</h2>

    {{-- Erros de validação --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="form-label">Nome completo</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Digite seu nome completo" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" placeholder="Digite seu e-mail"
                required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr class="divider">

        <div class="mb-4">
            <label for="password" class="form-label">Senha</label>
            <div>
                <input type="password" id="password" name="password"
                    class="form-control pe-5 @error('password') is-invalid @enderror"
                    placeholder="Crie uma senha" required>
            </div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirmar senha</label>
            <div>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="form-control pe-5" placeholder="Repita a senha" required>
            </div>
        </div>

        <hr class="divider">

        <div class="mt-4">
            <button type="submit" class="btn btn-primary w-100 btn-login">
                Cadastre-se
            </button>
        </div>

        <div class="mt-3">
            <a href="{{ route('login') }}" class="btn w-100">
                Já tenho uma conta — Entrar
            </a>
        </div>

    </form>

</div>

                </div>
            </div>
            <a href="{{ route('home') }}" class="btn btn-light fw-bold">
                Voltar
            </a>
        </div>



    @endsection
