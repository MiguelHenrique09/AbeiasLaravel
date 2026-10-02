@extends('layouts.app')

@section('title', 'Meus Pedidos — Abeias Burguer')

@section('content')
    <div class="container bg-dark py-5">

        {{-- Título --}}
        <div class="mb-4 mt-5 text-center">
            <h2 class="fw-bold text-white mb-0">Meus Pedidos</h2>
        </div>

        {{-- Filtro por status --}}
        <div class="d-flex justify-content-end align-items-center mb-4">
            <form method="GET">
                <select name="status" class="form-select bg-dark text-white" onchange="this.form.submit()"
                    style="min-width:220px;">
                    <option value="todos" @selected($status === 'todos')>Todos</option>
                    <option value="Confirmando" @selected($status === 'Confirmando')>Confirmando</option>
                    <option value="Preparando" @selected($status === 'Preparando')>Preparando</option>
                    <option value="Pronto" @selected($status === 'Pronto')>Pronto</option>
                </select>
            </form>
        </div>

        {{-- Lista de pedidos --}}
        <div class="card bg-dark text-white shadow-lg border-0 rounded-4">
            <div class="card-body p-4">

                @forelse ($pedidos as $pedido)
                    <div class="card p-3 mb-3 border-0 rounded-4 bg-white text-dark">
                        <div class="card-body">

                            <h5 class="fw-bold">Pedido {{ $pedido->idPedido }}</h5>

                            <p class="mb-1">
                                <strong>Cliente:</strong> {{ $pedido->user->name }}
                            </p>

                            <p class="mb-1">
                                <strong>Data:</strong> {{ $pedido->data_hora_pedido }}
                            </p>

                            <p class="mb-1"><strong>Produtos:</strong></p>
                            <i>Quantidade x Produto</i>

                            <ul class="list-unstyled ms-3 mb-2">
                                @foreach ($dados as $produto)
                                    @if ($produto->pedido_idPedido == $pedido->idPedido)
                                        <li>{{ $produto->quantidade }} {{ $produto->nome_produto }}</li>
                                    @endif
                                @endforeach
                            </ul>

                            <p class="mb-1">
                                <strong>Total:</strong>
                                R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}
                            </p>

                            <p class="mb-0">
                                <strong>Observações:</strong> {{ $pedido->observacoes }}
                            </p>

                            <p class="mb-0">
                                <strong>Status:</strong> {{ $pedido->statusPedido }}
                            </p>

                        </div>
                    </div>
                @empty
                    <div class="alert alert-light">Nenhum pedido encontrado.</div>
                @endforelse

                <div class="d-flex justify-content-center mt-4">
                    {{ $pedidos->links() }}
                </div>

                <a href="{{ route('facaPedido') }}" class="btn btn-light fw-bold">Voltar</a>
            </div>
        </div>

    </div>
@endsection
