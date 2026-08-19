<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use App\Models\ProdutoPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function clientePedido()
    {
        $produtos = Produto::where('ativo', 1)->get();

        return view('pages.facaPedido', compact('produtos'));
    }

    public function userCadastro()
    {
        return view('pages.usuarioCadastro');
    }

   
  public function logado(Request $request)
{
    $status = $request->query('status', 'todos');

    $query = Pedido::with('user')
        ->where('user_id', Auth::id())
        ->orderBy('data_hora_pedido', 'desc');

    if (in_array($status, ['Confirmando', 'Preparando', 'Pronto'])) {
        $query->where('statusPedido', $status);
    }

    $pedidos = $query->paginate(20);

    $dados = ProdutoPedido::with('produto')
        ->join('produto', 'produto_pedido.produto_idProduto', '=', 'produto.idProduto')
        ->whereIn('produto_pedido.pedido_idPedido', $pedidos->pluck('idPedido'))
        ->select(
            'produto_pedido.pedido_idPedido',
            'produto_pedido.quantidade',
            'produto.nome_produto'
        )
        ->get();

    return view('pages.meusPedidos', compact('pedidos', 'dados', 'status'));
}
public function AdminLogado(Request $request)
{
    $filtro = $request->query('status', 'todos');
    $busca = $request->query('busca');

    $query = Pedido::with('user');

    if ($filtro === 'recentes') {
        $query->orderBy('data_hora_pedido', 'desc');
    }

    if ($filtro === 'antigos') {
        $query->orderBy('data_hora_pedido', 'asc');
    }

    // Busca pelo nome do cliente
    if ($busca) {
        $query->whereHas('user', function ($q) use ($busca) {
            $q->where('nome_usuario', 'like', '%' . $busca . '%');
        });
    }

    $pedidos = $query->paginate(10);

    $dados1 = ProdutoPedido::with('produto')
        ->join(
            'produto',
            'produto_pedido.produto_idProduto',
            '=',
            'produto.idProduto'
        )
        ->whereIn(
            'produto_pedido.pedido_idPedido',
            $pedidos->pluck('idPedido')
        )
        ->select(
            'produto_pedido.pedido_idPedido',
            'produto_pedido.quantidade',
            'produto.nome_produto'
        )
        ->get();

    return view(
        'pages.gerenciaStatusp',
        compact('pedidos', 'dados1', 'filtro', 'busca')
    );
}

    public function atualizarStatus(Request $request, $id)
    {
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
        ], [
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.min' => 'O endereço deve ter pelo menos 7 caracteres.',
            'produto.required' => 'Selecione ao menos um produto.',
        ]);
        $temItemValido = false;

        foreach ($request->produto as $quantidade) {
            if ($quantidade > 0) {
                $temItemValido = true;
                break;
            }
        }

     if ($temItemValido == false) {
    return back()->withInput()->withErrors([ 'Selecione ao menos um produto ']);
}
        $valorTotal = 0;

        foreach ($request->produto as $idProduto => $quantidade) {
            if ($quantidade > 0) {
                $produto = Produto::find($idProduto);
                $valorTotal += $produto->preco_atual * $quantidade;
            }
        }

        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'data_hora_pedido' => now(),
            'statusPedido' => 'Confirmando',
            'observacoes' => $request->observacoes ?: 'Sem observações',
            'endereco' => $request->endereco,
            'valor_total' => $valorTotal,
        ]);

        foreach ($request->produto as $idProduto => $quantidade) {
            if ($quantidade > 0) {
                $produto = Produto::find($idProduto);

                $pedido->produtos()->attach($idProduto, [
                    'quantidade' => $quantidade,
                    'preco_unitario' => $produto->preco_atual,
                ]);
            }
        }

        return redirect()->route('meusPedidos')
            ->with('successo', 'Pedido realizado com sucesso!');
    }
}
