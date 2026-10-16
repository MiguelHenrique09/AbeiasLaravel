<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
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
            // Agrupado por semana 
            $inicioSemana = $dataInicio->copy();
            $numeroSemana = 1;
            while ($inicioSemana <= Carbon::today()) {
                $fimSemana = $inicioSemana->copy()->addDays(6)->min(Carbon::today())->endOfDay();
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
                $mesRef = Carbon::now()->subMonthsNoOverflow($i);
                $pedidosPorPeriodo[] = [
                    'label' => $mesRef->translatedFormat('M'),
                    'total' => Pedido::whereYear('data_hora_pedido', $mesRef->year)
                        ->whereMonth('data_hora_pedido', $mesRef->month)
                        ->count(),
                ];
            }
        }

        $totaisPeriodo = array_column($pedidosPorPeriodo, 'total');
        $maxPedidosPeriodo = !empty($totaisPeriodo) ? max($totaisPeriodo) : 1;

        // Top 3 produtos mais vendidos no período
        $produtosMaisVendidos = DB::table('produto_pedido')
            ->join('produtos', 'produtos.idProduto', '=', 'produto_pedido.produto_idProduto')
            ->join('pedidos', 'pedidos.idPedido', '=', 'produto_pedido.pedido_idPedido')
            ->whereNull('pedidos.deleted_at')
            ->whereBetween('pedidos.data_hora_pedido', [$dataInicio, Carbon::now()])
            ->select('produtos.nome_produto', DB::raw('SUM(produto_pedido.quantidade) as total_vendido'))
            ->groupBy('produtos.nome_produto')
            ->orderByDesc('total_vendido')
            ->limit(3)
            ->get();
        $maxVendido = $produtosMaisVendidos->max('total_vendido') ?: 1;

        // 5 clientes com mais pedidos no período
        $clientesTop = Pedido::select('user_id', DB::raw('COUNT(*) as total_pedidos'), DB::raw('SUM(valor_total) as total_gasto'))
            ->whereBetween('data_hora_pedido', [$dataInicio, Carbon::now()])
            ->groupBy('user_id')
            ->orderByDesc('total_pedidos')
            ->limit(5)
            ->with('user')
            ->get();

        return view('paginas.admin.relatorioVendas', compact(
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