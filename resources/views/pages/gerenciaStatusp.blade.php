@extends('layouts.app')

@section('content')

<div class="container bg-dark py-5">

    
    <div class="mb-4 mt-5">
        <h2 class="fw-bold text-white">Gerenciar Status dos Pedidos</h2>
        <small class="text-muted">
            Atualize o status de cada pedido do sistema
        </small>
    </div>
 <div class="d-flex gap-2 mb-3">

          

            <form method="GET" class="d-flex gap-2">
                <select name="status" class="form-select bg-dark text-white" onchange="this.form.submit()">
                    <option value="todos" {{ $filtro === 'todos' ? 'selected' : '' }}>Todos</option>
                    <option value="recentes" {{ $filtro === 'recentes' ? 'selected' : '' }}>Recentes</option>
                    <option value="antigos" {{ $filtro === 'antigos' ? 'selected' : '' }}>Antigos</option>

                </select>

            </form>

        </div>
    <div class="card border-0 bg-dark shadow-sm p-3">

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle ">

                    <thead class="border-bottom">
                        <tr>
                            <th class="ps-4">Pedido</th>
                            <th>Cliente</th>
                            <th>Data</th>
                            <th>Produtos</th>
                            <th>Total</th>
                            <th>Observações</th>
                            <th class="pe-4">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pedidos as $pedido)
                            <tr>

                                <td class="ps-4">#{{ $pedido->idPedido }}</td>

                                <td>{{ $pedido->user->name }}</td>

                                <td>{{ $pedido->data_hora_pedido }}</td>

                                <td>
                                    @forelse($dados1 as $produto)
                                        @if ($produto->pedido_idPedido == $pedido->idPedido)
                                            {{ $produto->quantidade }}x {{ $produto->nome_produto }}<br>
                                        @endif
                                    @empty
                                        -
                                    @endforelse
                                </td>

                                <td>
                                    R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}
                                </td>

                                <td>
                                    {{ $pedido->observacoes ?: '-' }}
                                </td>

                                <td class="pe-4">
                                    <form action="{{ route('atualizarStatus', ['id' => $pedido->idPedido]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <select class="form-select form-select-sm"
                                                name="statusPedido"
                                                onchange="this.form.submit()">

                                            <option value="Confirmando"
                                                @selected($pedido->statusPedido == 'Confirmando')>
                                                Confirmando
                                            </option>

                                            <option value="Preparando"
                                                @selected($pedido->statusPedido == 'Preparando')>
                                                Preparando
                                            </option>

                                            <option value="Pronto"
                                                @selected($pedido->statusPedido == 'Pronto')>
                                                Pronto
                                            </option>

                                        </select>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    Nenhum pedido encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
  <div class="d-flex justify-content-center mt-4">
                {{ $pedidos->links() }}
            </div>
             <div class="mt-3">
            <a href="{{ route('homeAdmin') }}" class="btn btn-light fw-bold">
                Voltar
            </a>
        </div>

        </div>

</div>

@endsection