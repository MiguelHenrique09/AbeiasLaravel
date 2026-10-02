<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Cloudinary\Cloudinary;
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

        $produtos = $query->paginate(15)->withQueryString();

        return view('paginas.cardapio', compact('produtos', 'filtro', 'busca'));
    }

    public function indexAdminProdutos(Request $request)
    {
        $filtro = $request->query('status', 'todos');
        $busca = $request->query('busca');

        $query = Produto::query();

        if ($filtro === 'ativos') $query->where('ativo', 1);
        if ($filtro === 'inativos') $query->where('ativo', 0);
        if ($filtro === 'recentes') $query->orderBy('created_at', 'desc');
        if ($filtro === 'antigos') $query->orderBy('created_at', 'asc');
        if ($busca) $query->where('nome_produto', 'like', '%' . $busca . '%');

        $produtos = $query->paginate(10)->withQueryString();

        return view('paginas.admin.gerenciaProduto', compact('produtos', 'filtro', 'busca'));
    }

    public function cria(Request $request)
    {
        $request->validate([
            'nome_produto' => 'required|string|max:255',
            'descricao_produto' => 'nullable|string',
            'preco_atual' => 'required|numeric|min:0',
            'tipo_Produto' => 'required|string',
            'imagem' => 'nullable|image|max:2048',
        ]);

        Produto::create([
            'nome_produto' => $request->nome_produto,
            'descricao' => $request->descricao_produto,
            'preco_atual' => $request->preco_atual,
            'tipo_Produto' => $request->tipo_Produto,
            'imagem_url' => $this->enviarImagem($request),
            'ativo' => 1,
        ]);

        return redirect()->back()->with('success', 'Produto adicionado com sucesso!');
    }

    public function atualizar(Request $request, $id)
    {
        $request->validate([
            'descricao_produto' => 'nullable|string',
            'preco_atual' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|max:2048',
        ]);

        $produto = Produto::findOrFail($id);

        $dados = [
            'descricao' => $request->descricao_produto,
            'preco_atual' => $request->preco_atual,
        ];

        if ($url = $this->enviarImagem($request)) {
            $dados['imagem_url'] = $url;
        }

        $produto->update($dados);

        return redirect()->back();
    }

    public function atualizarStatus($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->ativo = ! $produto->ativo;
        $produto->save();

        return redirect()->back();
    }

    private function enviarImagem(Request $request): ?string
    {
        if (! $request->hasFile('imagem')) {
            return null;
        }

        $cloudinary = new Cloudinary(config('services.cloudinary.url'));

        $resultado = $cloudinary->uploadApi()->upload(
            $request->file('imagem')->getRealPath(),
            ['folder' => 'abeias']
        );

        return $resultado['secure_url'];
    }
}
