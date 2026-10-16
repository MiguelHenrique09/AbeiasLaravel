<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use App\Models\ProdutoPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PedidoController extends Controller
{
    public function clientePedido()
    {
        $produtos = Produto::where('ativo', 1)->get();

        return view('paginas.cliente.facaPedido', compact('produtos'));
    }



    public function logado(Request $request)
    {
        $status = $request->query('status', 'todos');

        $query = Pedido::where('user_id', Auth::id())
            ->orderBy('data_hora_pedido', 'desc');

        if (in_array($status, ['Confirmando', 'Preparando', 'Pronto'])) {
            $query->where('statusPedido', $status);
        }

        $pedidos = $query->paginate(20)->withQueryString();

        $dados = ProdutoPedido::join('produtos', 'produto_pedido.produto_idProduto', '=', 'produtos.idProduto')
            ->whereIn('produto_pedido.pedido_idPedido', $pedidos->pluck('idPedido'))
            ->select(
                'produto_pedido.pedido_idPedido',
                'produto_pedido.quantidade',
                'produtos.nome_produto'
            )
            ->get();

        return view('paginas.cliente.meusPedidos', compact('pedidos', 'dados', 'status'));
    }




public function AdminLogado(Request $request)
{
    $filtro = $request->query('status', 'todos');
    $busca = $request->query('busca');

    $query = Pedido::with('user')->orderBy('data_hora_pedido', 'desc');

    if (in_array($filtro, ['Confirmando', 'Preparando', 'Pronto'])) {
        $query->where('statusPedido', $filtro);
    }

    if ($busca) {
        $query->whereHas('user', function ($q) use ($busca) {
            $q->where('nome', 'like', '%' . $busca . '%');
        });
    }

    $pedidos = $query->paginate(10)->withQueryString();

    $dados1 = ProdutoPedido::join('produtos', 'produto_pedido.produto_idProduto', '=', 'produtos.idProduto')
        ->whereIn('produto_pedido.pedido_idPedido', $pedidos->pluck('idPedido'))
        ->select(
            'produto_pedido.pedido_idPedido',
            'produto_pedido.quantidade',
            'produtos.nome_produto'
        )
        ->get();

    return view('paginas.admin.gerenciaStatusp', compact('pedidos', 'dados1', 'filtro', 'busca'));
}




    public function atualizarStatus(Request $request, $id)
    {
        $request->validate([
            'statusPedido' => ['required', Rule::in(['Confirmando', 'Preparando', 'Pronto'])],
        ]);

        $pedido = Pedido::findOrFail($id);

        $pedido->statusPedido = $request->statusPedido;
        $pedido->save();

        return back();
    }



    
    public function salvar(Request $request)
    {
        $request->validate([
            'endereco' => 'required|min:7',
            'observacoes' => 'nullable|string',
            'produto' => 'required|array',
            'produto.*' => 'nullable|integer|min:0',
        ], [
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.min' => 'O endereço deve ter pelo menos 7 caracteres.',
            'produto.required' => 'Selecione ao menos um produto.',
        ]);

        // Só os itens com quantidade maior que zero
        $itens = array_filter($request->produto, fn ($quantidade) => $quantidade > 0);

        if (count($itens) === 0) {
            return back()->withInput()->withErrors(['Selecione ao menos um produto']);
        }

        $produtos = Produto::whereIn('idProduto', array_keys($itens))
            ->where('ativo', 1)
            ->get()
            ->keyBy('idProduto');

        if ($produtos->count() !== count($itens)) {
            return back()->withInput()->withErrors(['Um dos produtos não está mais disponível']);
        }

        DB::transaction(function () use ($request, $itens, $produtos) {
            $valorTotal = 0;
            $linhas = [];

            foreach ($itens as $idProduto => $quantidade) {
                $preco = $produtos[$idProduto]->preco_atual;
                $valorTotal += $preco * $quantidade;
                $linhas[$idProduto] = [
                    'quantidade' => $quantidade,
                    'preco_unitario' => $preco,
                ];
            }

            $pedido = Pedido::create([
                'user_id' => Auth::id(),
                'data_hora_pedido' => now(),
                'statusPedido' => 'Confirmando',
                'observacoes' => $request->observacoes ?: 'Sem observações',
                'endereco' => $request->endereco,
                'valor_total' => $valorTotal,
            ]);

            $pedido->produtos()->attach($linhas);
        });

        return redirect()->route('meusPedidos');
          
    }
}