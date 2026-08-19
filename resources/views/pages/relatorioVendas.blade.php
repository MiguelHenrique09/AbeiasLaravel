@extends('layouts.app')

@section('content')
<div class="container py-5 bg-dark rounded-3">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 mt-5">
        <div>
            <h2 class="fw-bold text-white mb-0">Relatórios</h2>
            <small class="text-muted">Visão geral do sistema</small>
        </div>

        <form method="GET">
            <select name="periodo" class="form-select bg-dark text-white" onchange="this.form.submit()" style="min-width:180px;">
                <option value="hoje" {{ $periodo === 'hoje' ? 'selected' : '' }}>Hoje</option>
                <option value="semana" {{ $periodo === 'semana' ? 'selected' : '' }}>Última semana</option>
                <option value="mes" {{ $periodo === 'mes' ? 'selected' : '' }}>Último mês</option>
                <option value="ano" {{ $periodo === 'ano' ? 'selected' : '' }}>Último ano</option>
            </select>
        </form>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="p-3 rounded-3" style="background:#0e1240;">
                <p class="mb-1" style="color:#9aa0c3; font-size:13px;">Pedidos no período</p>
                <p class="mb-0 text-white fw-medium" style="font-size:24px;">{{ $pedidosPeriodo }}</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 rounded-3" style="background:#0e1240;">
                <p class="mb-1" style="color:#9aa0c3; font-size:13px;">Faturamento</p>
                <p class="mb-0 text-white fw-medium" style="font-size:24px;">
                    R$ {{ number_format($faturamentoPeriodo, 2, ',', '.') }}
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 rounded-3" style="background:#0e1240;">
                <p class="mb-1" style="color:#9aa0c3; font-size:13px;">Produtos ativos</p>
                <p class="mb-0 text-white fw-medium" style="font-size:24px;">{{ $produtosAtivos }}</p>
            </div>
        </div>

    </div>

    <div class="row g-3">

        <div class="col-md-7">
            <div class="p-3 rounded-3 h-100" style="background:#0e1240;">
                <p class="text-white fw-medium mb-3" style="font-size:14px;">Pedidos no período</p>

                <div class="d-flex align-items-end gap-2" style="height:120px;">
                    @foreach ($pedidosPorPeriodo as $item)
                        @php
                            $altura = $maxPedidosPeriodo > 0 ? ($item['total'] / $maxPedidosPeriodo) * 100 : 0;
                        @endphp
                        <div class="flex-fill rounded-top"
                             style="background:#FEA116; height: {{ max($altura, 4) }}%;"
                             title="{{ $item['total'] }} pedidos">
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between mt-2">
                    @foreach ($pedidosPorPeriodo as $item)
                        <span style="color:#6a6f96; font-size:11px;">{{ ucfirst($item['label']) }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="p-3 rounded-3 h-100" style="background:#0e1240;">
                <p class="text-white fw-medium mb-3" style="font-size:14px;">Produtos mais vendidos</p>

                @forelse ($produtosMaisVendidos as $produto)
                    @php
                        $largura = $maxVendido > 0 ? ($produto->total_vendido / $maxVendido) * 100 : 0;
                    @endphp
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <span style="color:#c9cde0; font-size:13px;">{{ $produto->nome_produto }}</span>
                            <span style="color:#9aa0c3; font-size:13px;">{{ $produto->total_vendido }}</span>
                        </div>
                        <div class="rounded" style="background:#1b1f4a; height:6px;">
                            <div class="rounded" style="background:#FEA116; width: {{ $largura }}%; height:100%;"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0" style="font-size:13px;">Nenhuma venda registrada ainda.</p>
                @endforelse
            </div>
        </div>

    </div>

    {{-- CLIENTES COM MAIS PEDIDOS --}}
    <div class="mt-4 p-3 rounded-3" style="background:#0e1240;">
        <p class="text-white fw-medium mb-3" style="font-size:14px;">Clientes com mais pedidos</p>

        <div class="table-responsive">
            <table class="table table-dark table-borderless align-middle mb-0" style="font-size:13px;">
                <thead>
                    <tr style="color:#6a6f96;">
                        <th class="fw-normal">Cliente</th>
                        <th class="fw-normal">Email</th>
                        <th class="fw-normal text-end">Pedidos</th>
                        <th class="fw-normal text-end">Total gasto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientesTop as $cliente)
                        <tr style="border-top: 0.5px solid #1b1f4a;">
                            <td>{{ $cliente->user->name ?? 'Cliente removido' }}</td>
                            <td style="color:#9aa0c3;">{{ $cliente->user->email ?? '-' }}</td>
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
            <a href="{{ route('homeAdmin') }}" class="btn btn-light fw-bold">
                Voltar
            </a>
        </div>

    </div>

</div>
@endsection