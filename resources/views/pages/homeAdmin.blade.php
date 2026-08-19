@extends('layouts.app')

@section('content')
    <div class="container bg-dark py-5">




        <div class="mb-4 mt-5">

            <div>
                <h2 class="fw-bold mb-0 text-white">Painel Administrativo</h2>
                <small class="text-muted">Gerencie todo o sistema do trailer
                </small>
            </div>

        </div>


        <div class="row g-4">

            <!-- CARD -->
            <div class="col-12 col-md-6">
                <a href="{{ route('gerenciaStatusp') }}" class="nav-link">
                    <div class="card border-0 shadow-sm h-100 p-4 text-center card-hover">

                        <div class="card-body d-flex flex-column justify-content-center">

                            <h4 class="fw-bold">Pedidos</h4>
                            <p class="text-muted mb-0" "
        >Gerenciar status dos pedidos</p>
                            </div>

                        </div>

                    </a>
                </div>
                <!-- CARD -->
                   <div class="col-12 col-md-6">
                    <a href="{{ route('EditaProdutos') }}" class="nav-link">
                        <div class="card border-0 shadow-sm h-100 p-4 text-center card-hover">

                            <div class="card-body d-flex flex-column justify-content-center">

                                <h4 class="fw-bold">Produtos</h4>
                                <p class="text-muted mb-0" ">Gerencia produtos</p>
                        </div>

                    </div>

                </a>
            </div>

            <!-- CARD -->
            <div class="col-12 col-md-6">
                <a href="{{ route('listaClientes') }}" class="nav-link">

                    <div class="card border-0 shadow-sm h-100 p-4 text-center card-hover">

                        <div class="card-body d-flex flex-column justify-content-center">

                            <h4 class="fw-bold">Usuário</h4>
                            <p class="text-muted mb-0">Listar usuários</p>

                        </div>

                    </div>

                </a>
            </div>

            <!-- CARD -->
            <div class="col-12 col-md-6">
                <a href="{{ route('relatorioVendas') }}" class="nav-link">

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
