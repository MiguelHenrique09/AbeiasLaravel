<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class CardapioController extends Controller

{
public function indexClientesProdutos(Request $request)
{
    $filtro = $request->query('status', 'todos');
    $busca = $request->query('busca');

    $query = Produto::query()->where('ativo', 1);

    if (in_array($filtro, ['Lanche', 'Porção', 'Bebida'])) {
        $query->where('tipo_Produto', $filtro);
    }

    if ($busca) {
        $query->where('nome_produto', 'like', '%' . $busca . '%');
    }

    $produtos = $query->paginate(15);

    return view('pages.cardapio', compact('produtos', 'filtro', 'busca'));
}


   public function indexAdminProdutos(Request $request)
{
    $filtro = $request->query('status', 'todos');
    $busca = $request->query('busca');

    $query = Produto::query();

    if ($filtro === 'ativos') $query->where('ativo', 1);
    if ($filtro  === 'inativos') $query->where('ativo', 0);
    if ($filtro === 'recentes') $query->orderBy('created_at', 'desc');
    if ($filtro === 'antigos ') $query->orderBy('created_at', 'asc');
    if ($busca) $query->where('nome_produto', 'like', '%' . $busca . '%');

    $produtos = $query->paginate(10);

    return view('pages.gerenciaProduto', compact('produtos', 'filtro', 'busca'));
}

    public function cria(Request $request)
    {
        $request->validate([
            'nome_produto' => 'required|string|max:255',
            'descricao_produto' => 'nullable|string',
            'preco_atual' => 'required|numeric|min:0',
            'tipo_Produto' => 'required|string',
        ]);

        Produto::create([
            'nome_produto' => $request->nome_produto,
            'descricao' => $request->descricao_produto,
            'preco_atual' => $request->preco_atual,
            'tipo_Produto' => $request->tipo_Produto,
            'ativo' => 1,
        ]);

        return redirect()->back()->with('success', 'Produto adicionado com sucesso!');
    }

    //
    public function atualizar(Request $request, $id)
    {
        $request->validate([
            'descricao_produto' => 'nullable|string',
            'preco_atual' => 'required|numeric|min:0',
        ]);

        $produto = Produto::findOrFail($id);

        $produto->atualizar([
            'descricao' => $request->descricao_produto,
            'preco_atual' => $request->preco_atual,
        ]);

        return redirect()->back();
    }

    //
    public function atualizarStatus($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->ativo = ! $produto->ativo;
        $produto->save();

        return redirect()->back();
    }
}
