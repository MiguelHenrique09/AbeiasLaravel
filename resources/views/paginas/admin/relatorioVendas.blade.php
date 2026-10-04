@extends('layouts.app')

@section('title', 'Relatórios — Abeias Burguer')

@section('content')
    <div class="container py-5 bg-dark rounded-3">

        {{-- Título e filtro de período --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 mt-5">
            <div>
                <h2 class="fw-bold text-white mb-0">Relatórios</h2>
                <small class="text-muted">Visão geral do sistema</small>
            </div>

            <form method="GET">
                <select name="periodo" class="form-select bg-dark text-white" onchange="this.form.submit()"
                    style="min-width:180px;">
                    <option value="hoje" @selected($periodo === 'hoje')>Hoje</option>
                    <option value="semana" @selected($periodo === 'semana')>Última semana</option>
                    <option value="mes" @selected($periodo === 'mes')>Último mês</option>
                    <option value="ano" @selected($periodo === 'ano')>Último ano</option>
                </select>
            </form>
        </div>

        {{-- Indicadores --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="rel-card p-3 rounded-3">
                    <p class="rel-label mb-1">Pedidos no período</p>
                    <p class="rel-valor mb-0 text-white fw-medium">{{ $pedidosPeriodo }}</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="rel-card p-3 rounded-3">
                    <p class="rel-label mb-1">Faturamento</p>
                    <p class="rel-valor mb-0 text-white fw-medium">
                        R$ {{ number_format($faturamentoPeriodo, 2, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="rel-card p-3 rounded-3">
                    <p class="rel-label mb-1">Produtos ativos</p>
                    <p class="rel-valor mb-0 text-white fw-medium">{{ $produtosAtivos }}</p>
                </div>
            </div>
        </div>

        <div class="row g-3">

            {{-- Gráfico de pedidos --}}
            <div class="col-md-7">
                <div class="rel-card p-3 rounded-3 h-100">
                    <p class="rel-titulo text-white fw-medium mb-3">Pedidos no período</p>

                    <div class="rel-grafico d-flex align-items-end gap-2">
                        @foreach ($pedidosPorPeriodo as $item)
                            @php
                                $altura = $maxPedidosPeriodo > 0 ? ($item['total'] / $maxPedidosPeriodo) * 100 : 0;
                            @endphp
                            <div class="rel-coluna flex-fill rounded-top" style="height: {{ max($altura, 4) }}%;"
                                title="{{ $item['total'] }} pedidos"></div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        @foreach ($pedidosPorPeriodo as $item)
                            <span class="rel-eixo">{{ ucfirst($item['label']) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Produtos mais vendidos --}}
            <div class="col-md-5">
                <div class="rel-card p-3 rounded-3 h-100">
                    <p class="rel-titulo text-white fw-medium mb-3">Produtos mais vendidos</p>

                    @forelse ($produtosMaisVendidos as $produto)
                        @php
                            $largura = $maxVendido > 0 ? ($produto->total_vendido / $maxVendido) * 100 : 0;
                        @endphp
                        <div class="mb-2">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="rel-nome">{{ $produto->nome_produto }}</span>
                                <span class="rel-label">{{ $produto->total_vendido }}</span>
                            </div>
                            <div class="rel-trilho rounded">
                                <div class="rel-barra rounded" style="width: {{ $largura }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <p class="rel-label text-muted mb-0">Nenhuma venda registrada ainda.</p>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- Clientes com mais pedidos --}}
        <div class="rel-card mt-4 p-3 rounded-3">
            <p class="rel-titulo text-white fw-medium mb-3">Clientes com mais pedidos</p>

            <div class="table-responsive">
                <table class="rel-tabela table table-dark table-borderless align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="fw-normal">Cliente</th>
                            <th class="fw-normal">Email</th>
                            <th class="fw-normal text-end">Pedidos</th>
                            <th class="fw-normal text-end">Total gasto</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($clientesTop as $cliente)
                            <tr class="rel-linha">
                                <td>{{ $cliente->user->nome ?? 'Cliente removido' }}</td>
                                <td class="rel-label">{{ $cliente->user->email ?? '-' }}</td>
                                <td class="text-end">{{ $cliente->total_pedidos }}</td>
                                <td class="text-end">R$ {{ number_format($cliente->total_gasto, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Nenhum pedido registrado ainda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ route('homeAdmin') }}" class="btn btn-light fw-bold">Voltar</a>
            </div>
        </div>

    </div>
@endsection
