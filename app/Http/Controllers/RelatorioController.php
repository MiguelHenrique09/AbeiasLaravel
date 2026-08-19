<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        $periodo = $request->query('periodo', 'hoje');

        $dataInicio = match ($periodo) {
            'semana' => Carbon::today()->subDays(6),
            'mes'    => Carbon::today()->subDays(29),
            'ano'    => Carbon::today()->subDays(364),
            default  => Carbon::today(), // 'hoje'
        };

        $pedidosPeriodo = Pedido::whereBetween('data_hora_pedido', [$dataInicio, Carbon::now()])->count();

        $faturamentoPeriodo = Pedido::whereBetween('data_hora_pedido', [$dataInicio, Carbon::now()])->sum('valor_total');

        $produtosAtivos = Produto::where('ativo', 1)->count();

        // Gráfico: agrupamento inteligente conforme o período
        $pedidosPorPeriodo = [];

        if ($periodo === 'hoje' || $periodo === 'semana') {
            // Um ponto por dia
            $dataAtual = $dataInicio->copy();
            while ($dataAtual <= Carbon::today()) {
                $pedidosPorPeriodo[] = [
                    'label' => $dataAtual->translatedFormat('D'), // Seg, Ter...
                    'total' => Pedido::whereDate('data_hora_pedido', $dataAtual)->count(),
                ];
                $dataAtual->addDay();
            }
        } elseif ($periodo === 'mes') {
            // Agrupado por semana (janelas de 7 dias)
            $inicioSemana = $dataInicio->copy();
            $numeroSemana = 1;
            while ($inicioSemana <= Carbon::today()) {
                $fimSemana = $inicioSemana->copy()->addDays(6)->min(Carbon::today());
                $pedidosPorPeriodo[] = [
                    'label' => 'Sem ' . $numeroSemana,
                    'total' => Pedido::whereBetween('data_hora_pedido', [$inicioSemana, $fimSemana])->count(),
                ];
                $inicioSemana->addDays(7);
                $numeroSemana++;
            }
        } else { // 'ano'
            // Agrupado por mês
            for ($i = 11; $i >= 0; $i--) {
                $mesRef = Carbon::now()->subMonths($i);
                $pedidosPorPeriodo[] = [
                    'label' => $mesRef->translatedFormat('M'),
                    'total' => Pedido::whereYear('data_hora_pedido', $mesRef->year)
                        ->whereMonth('data_hora_pedido', $mesRef->month)
                        ->count(),
                ];
            }
        }

        $maxPedidosPeriodo = max(array_column($pedidosPorPeriodo, 'total')) ?: 1;

        // Produtos mais vendidos no período (top 3)
        $produtosMaisVendidos = DB::table('produto_pedido')
            ->join('produto', 'produto.idProduto', '=', 'produto_pedido.produto_idProduto')
            ->join('pedido', 'pedido.idPedido', '=', 'produto_pedido.pedido_idPedido')
            ->whereBetween('pedido.data_hora_pedido', [$dataInicio, Carbon::now()])
            ->select('produto.nome_produto', DB::raw('SUM(produto_pedido.quantidade) as total_vendido'))
            ->groupBy('produto.nome_produto')
            ->orderByDesc('total_vendido')
            ->limit(3)
            ->get();
        $maxVendido = $produtosMaisVendidos->max('total_vendido') ?: 1;

        // Clientes com mais pedidos no período (top 5)
        $clientesTop = Pedido::select('user_id', DB::raw('COUNT(*) as total_pedidos'), DB::raw('SUM(valor_total) as total_gasto'))
            ->whereBetween('data_hora_pedido', [$dataInicio, Carbon::now()])
            ->groupBy('user_id')
            ->orderByDesc('total_pedidos')
            ->limit(5)
            ->with('user')
            ->get();

        return view('pages.relatorioVendas', compact(
            'periodo',
            'pedidosPeriodo',
            'faturamentoPeriodo',
            'produtosAtivos',
            'pedidosPorPeriodo',
            'maxPedidosPeriodo',
            'produtosMaisVendidos',
            'maxVendido',
            'clientesTop'
        ));
    }
}