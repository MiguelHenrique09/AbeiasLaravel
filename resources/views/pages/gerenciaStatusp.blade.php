@extends('layouts.app')

@section('content')

<div class="container bg-dark py-5">

    {{-- TÍTULO --}}
    <div class="mb-4 mt-3">
        <h2 class="fw-bold text-white">Gerenciar Status dos Pedidos</h2>
        <small class="text-muted">Atualize o status de cada pedido do sistema</small>
    </div>

    {{-- TABELA --}}
    <div class="card border-0 bg-dark shadow-sm p-3">

        <div class=" bg-dark table-responsive">

            <table class="table table-dark table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pedidos as $pedido)

                        <tr>

                            {{-- ID --}}
                            <td>{{ $pedido->idPedido }}</td>

                            {{-- CLIENTE --}}
                            <td>
                                {{ $pedido->user->name ?? 'Cliente não encontrado' }}
                            </td>

                            {{-- ITENS (se tiver relação depois você pode melhorar isso) --}}
                           

                            {{-- TOTAL --}}
                            <td>
                                <strong>
                                    R$ {{ number_format($pedido->valor_total ?? 0, 2, ',', '.') }}
                                </strong>
                            </td>

                            {{-- STATUS EDITÁVEL --}}
                            <td>

                                <form action="{{ url('Pedido/atualizarStatus/'.$pedido->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <select name="status" class="form-select form-select-sm bg-dark text-white">

                                        <option value="Confirmando" {{ $pedido->status == 'Confirmando' ? 'selected' : '' }}>
                                            Confirmando
                                        </option>

                                        <option value="Preparando" {{ $pedido->status == 'Preparando' ? 'selected' : '' }}>
                                            Preparando
                                        </option>

                                        <option value="Pronto" {{ $pedido->status == 'Pronto' ? 'selected' : '' }}>Pronto     
                                       </option>

                                      
                                    </select>

                            </td>

                            

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Nenhum pedido encontrado
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
      <a href="{{ route('homeAdmin') }}" class="btn btn-light fw-bold">
                    Voltar
                </a>
            </div>

</div>

@endsection











