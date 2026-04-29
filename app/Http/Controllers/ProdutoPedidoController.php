<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoPedidoController extends Controller
{
    public function index()
    {
        $dados = DB::table('produto_pedido')->get();

        //return view('produto_pedido.index', compact('dados'));
    }

    public function store(Request $request)
    {
        DB::table('produto_pedido')->insert([
            'pedido_idPedido' => $request->pedido_idPedido,
            'produto_idProduto' => $request->produto_idProduto,
            'quantidade' => $request->quantidade,
            'preco_unitario' => $request->preco_unitario
        ]);

        return redirect('/produto_pedido');
    }

    public function destroy($pedido, $produto)
    {
        DB::table('produto_pedido')
            ->where('pedido_idPedido', $pedido)
            ->where('produto_idProduto', $produto)
            ->delete();

        return redirect('/produto_pedido');
    }
}