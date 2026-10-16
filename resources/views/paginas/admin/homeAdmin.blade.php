@extends('layouts.app')

@section('title', 'Painel Administrativo — Abeias Burguer')

@section('content')
    <style>
        /* remove a faixa branca entre o painel e o rodapé */
        main,
        .main-content,
        .content {
            background-color: #050a2a !important; /* mesmo tom escuro do container */
            min-height: 0 !important;
        }
    </style>

    <div class="container bg-dark py-5">

        <div class="mb-4 mt-5">
            <h2 class="fw-bold mb-0 text-white">Painel Administrativo</h2>
            <small class="text-white-50">Gerencie todo o sistema do trailer</small>
        </div>

        <div class="row g-4">

            {{-- Pedidos --}}
            <div class="col-12 col-md-6">
                <a href="{{ route('gerenciaStatusp') }}" class="d-block h-100 text-decoration-none text-reset">
                    <div class="card border-0 shadow-sm h-100 p-4 text-center card-hover">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h4 class="fw-bold">Pedidos</h4>
                            <p class="text-muted mb-0">Gerenciar status dos pedidos</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Produtos --}}
            <div class="col-12 col-md-6">
                <a href="{{ route('EditaProdutos') }}" class="d-block h-100 text-decoration-none text-reset">
                    <div class="card border-0 shadow-sm h-100 p-4 text-center card-hover">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h4 class="fw-bold">Produtos</h4>
                            <p class="text-muted mb-0">Gerenciar produtos</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Usuários --}}
            <div class="col-12 col-md-6">
                <a href="{{ route('listaClientes') }}" class="d-block h-100 text-decoration-none text-reset">
                    <div class="card border-0 shadow-sm h-100 p-4 text-center card-hover">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h4 class="fw-bold">Usuários</h4>
                            <p class="text-muted mb-0">Listar usuários</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Relatórios --}}
            <div class="col-12 col-md-6">
                <a href="{{ route('relatorioVendas') }}" class="d-block h-100 text-decoration-none text-reset">
                    <div class="card border-0 shadow-sm h-100 p-4 text-center card-hover">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h4 class="fw-bold">Relatórios</h4>
                            <p class="text-muted mb-0">Consultar pedidos</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection