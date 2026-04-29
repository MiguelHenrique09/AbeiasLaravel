<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;

class PedidoController extends Controller
{
    // Tela fazer pedido
    public function clientePedido()
    {
        $produtos = Produto::where('ativo', 1)->get();

        return view('pages.facaPedido', compact('produtos'));
    }

    // Tela cadastro usuário
    public function userCadastro()
    {
        return view('pages.usuarioCadastro');
    }

    // Página fazer pedido + pedidos do cliente específico
    public function index()
    {
        $produtos = Produto::all();

        $pedidos = Pedido::with('user')
            ->whereHas('user', function ($query) {
                $query->where('name', 'Mr. Torey Langosh Jr.');
            })
            ->get();

        return view('pages.facaPedido', compact('produtos', 'pedidos'));
    }

    // Página meus pedidos do cliente específico
    public function index2()
    {
        $pedidos = Pedido::with('user')
            ->whereHas('user', function ($query) {
                $query->where('name', 'Mr. Torey Langosh Jr.');
            })
            ->get();

        return view('pages.meusPedidos', compact('pedidos'));
    }
    public function index3()
{
    $pedidos = Pedido::with('user')->get();

    return view('pages.gerenciaStatusp', compact('pedidos'));
}
}