<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = DB::table('produto')
            ->whereNull('deleted_at')
            ->get();

        return view('pages.gerenciaProduto', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_produto' => 'required|string|max:100',
            'descricao'    => 'required|string',
            'preco_atual'  => 'required|numeric|min:0',
            'tipo_produto' => 'required|in:Bebida,Lanche,Porção',
        ]);

        DB::table('produto')->insert([
            'nome_produto' => $request->nome_produto,
            'descricao'    => $request->descricao,
            'preco_atual'  => $request->preco_atual,
            'tipo_produto' => $request->tipo_produto,
            'ativo'        => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect('/produtos');
    }

    public function inativar($id)
    {
        DB::table('produto')
            ->where('idProduto', $id)
            ->update([
                'ativo'      => false,
                'updated_at' => now(),
            ]);

        return redirect('/produtos');
    }

    public function destroy()
    {
        
    }
}