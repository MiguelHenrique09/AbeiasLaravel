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
                <a href="{{route('relatorioVendas') }}" class="nav-link">

                    <div class="card border-0 shadow-sm h-100 p-4 text-center card-hover">

                        <div class="card-body d-flex flex-column justify-content-center">

                            <h4 class="fw-bold">Relatórios</h4>
                            <p class="text-muted mb-0">Consultar pedidos</p>

                        </div>

                    </div>

                </a>
            </div>

        </div>
        <button type="button" class="btn btn-light fw-bold" id="openExitModal">
            Voltar
        </button>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="exitModal" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content rounded-4">

                <div class="modal-header">
                    <h5 class="modal-title">Sair do painel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Tem certeza que deseja sair da área administrativa?</p>
                    <small class="text-muted">Você será redirecionado para o login.</small>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button class="btn btn-danger" id="confirmExit">
                        Sim, sair
                    </button>
                </div>

            </div>

        </div>

    </div>

    </div>
    <!-- SCRIPT -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const modal = new bootstrap.Modal(document.getElementById('exitModal'));

            document.getElementById('openExitModal').addEventListener('click', function() {
                modal.show();
            });

            document.getElementById('confirmExit').addEventListener('click', function() {
                window.location.href = "{{ route('home') }}";
            });
        });
    </script>
@endsection
