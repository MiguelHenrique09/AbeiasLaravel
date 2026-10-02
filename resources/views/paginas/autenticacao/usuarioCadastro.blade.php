@extends('layouts.app')

@section('title', 'Cadastro — Abeias Burguer')

@section('content')
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
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Digite seu e-mail" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="divider">

                            <div class="mb-4">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Crie uma senha" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar senha</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" placeholder="Repita a senha" required>
                            </div>

                            <hr class="divider">

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-100 btn-login">Cadastre-se</button>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('login') }}" class="btn btn-outline-light w-100 btn-login">
                                    Já tenho uma conta — Entrar
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <a href="{{ route('home') }}" class="btn btn-light fw-bold">Voltar</a>
        </div>
    </div>
@endsection
