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

</div>
<div class="container bg-dark py-4">
<div class="container-fluid login-area">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card-login">

                <div class="mb-4">
                    <label class="text-white mb-2">E-mail</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Digite seu e-mail">
                </div>

                <div class="mb-4">
                    <label class="text-white mb-2">Senha</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Digite sua senha">
                </div>

                <div class="mb-4">
                    <label class="text-white mb-2">Entrar como</label>
                    <select id="tipo" name="tipo_usuario" class="form-select">
                        <option value="Cliente">Cliente</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>

                <div class="mt-4">
                    <button onclick="login()" class="btn btn-primary w-100 btn-login">
                        Entrar
                    </button>
                </div>

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

@push('scripts')
<script>
    function login() {
        let tipo = document.getElementById("tipo").value;

        if (tipo === "Cliente") {
            window.location.href = "{{ route('facaPedido') }}";
        } else if (tipo === "Administrador") {
            window.location.href =  "{{ route('homeAdmin') }}";
        }
    }
</script>
@endpush