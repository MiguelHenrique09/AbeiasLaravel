<?php
namespace App\Http\Controllers;

use App\Models\Produto;

class CardapioController extends Controller
{
    // Método que lista os produtos
    public function index()
    {
        // 1. Busca dados do banco
        $produtos = Produto::where('ativo', 1)->get();

        // 2. Manda para a view
        return view('pages.cardapio', compact('produtos'));
    }

      public function indexAdminProdutos()
    {
        // 1. Busca dados do banco
        $produtos = Produto::where('ativo', 1)->get();

        // 2. Manda para a view
        return view('pages.gerenciaProduto', compact('produtos'));
    }



 //public function indexPedido()
   // {
        // 1. Busca dados do banco
    //    $produtos = Produto::where('ativo', 1)->get();

    //    // 2. Manda para a view
   //    return view('pages.clientePedido', compact('produtos'));
   // }


   
 public function indexCarrinho()
    {
        // 1. Busca dados do banco
        $produtos = Produto::where('ativo', 1)->get();

        // 2. Manda para a view
        return view('pages/cliente.clienteCarrinho', compact('produtos'));
    }
    // Método que mostra um produto específico
  //  public function show($id)
  //  {
   //     $produto = Produto::findOrFail($id);
   //     return view('pages.produto', compact('produto'));
   // }
}