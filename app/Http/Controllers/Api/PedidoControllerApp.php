<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PedidoControllerApp extends Controller
{
    public function index(Request $request)
    {
        return Pedido::with('produtos')
            ->where('user_id', $request->user()->id)
            ->orderBy('data_hora_pedido', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'endereco' => 'required|string|min:7|max:200',
            'observacoes' => 'nullable|string',
            'itens' => 'required|array|min:1',
            'itens.*.idProduto' => [
                'required',
                Rule::exists('produtos', 'idProduto')->where('ativo', 1),
            ],
            'itens.*.quantidade' => 'required|integer|min:1',
        ], [
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.min' => 'O endereço deve ter pelo menos 7 caracteres.',
            'itens.required' => 'Adicione ao menos um produto.',
            'itens.min' => 'Adicione ao menos um produto.',
            'itens.*.idProduto.exists' => 'Um dos produtos não está mais disponível.',
        ]);

        $quantidades = [];
        foreach ($request->itens as $item) {
            $id = $item['idProduto'];
            $quantidades[$id] = ($quantidades[$id] ?? 0) + $item['quantidade'];
        }

        $pedido = DB::transaction(function () use ($request, $quantidades) {
            $produtos = Produto::whereIn('idProduto', array_keys($quantidades))->get();

            $total = 0;
            $linhas = [];

            foreach ($produtos as $produto) {
                $qtd = $quantidades[$produto->idProduto];
                $total += $produto->preco_atual * $qtd;
                $linhas[$produto->idProduto] = [
                    'quantidade' => $qtd,
                    'preco_unitario' => $produto->preco_atual,
                ];
            }

            $pedido = Pedido::create([
                'user_id' => $request->user()->id,
                'data_hora_pedido' => now(),
                'statusPedido' => 'Confirmando',
                'observacoes' => $request->observacoes ?: 'Sem observações',
                'endereco' => $request->endereco,
                'valor_total' => $total,
            ]);

            $pedido->produtos()->attach($linhas);

            return $pedido;
        });

        return response()->json($pedido->load('produtos'), 201);
    }
}