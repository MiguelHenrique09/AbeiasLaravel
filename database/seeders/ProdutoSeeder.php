<?php
 
namespace Database\Seeders;
 
use App\Models\Produto;
use Illuminate\Database\Seeder;
 
class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [
            ['nome_produto' => 'X-Burguer', 'descricao' => 'Pão, hambúrguer 150g, queijo, alface e tomate', 'preco_atual' => 18.90, 'tipo_produto' => 'Lanche', 'ativo' => true],
            ['nome_produto' => 'X-Bacon', 'descricao' => 'Pão, hambúrguer 150g, queijo, bacon crocante e maionese', 'preco_atual' => 22.90, 'tipo_produto' => 'Lanche', 'ativo' => true],
            ['nome_produto' => 'X-Salada', 'descricao' => 'Pão, hambúrguer 150g, queijo, alface, tomate e cebola roxa', 'preco_atual' => 19.90, 'tipo_produto' => 'Lanche', 'ativo' => true],
            ['nome_produto' => 'X-Tudo', 'descricao' => 'Pão, dois hambúrgueres, queijo, bacon, ovo, presunto e salada', 'preco_atual' => 28.90, 'tipo_produto' => 'Lanche', 'ativo' => true],
            ['nome_produto' => 'Cheeseburguer Duplo', 'descricao' => 'Dois hambúrgueres 100g, queijo cheddar duplo e molho especial', 'preco_atual' => 24.90, 'tipo_produto' => 'Lanche', 'ativo' => true],
            ['nome_produto' => 'Batata Frita', 'descricao' => 'Porção individual de batata frita crocante', 'preco_atual' => 14.90, 'tipo_produto' => 'Porção', 'ativo' => true],
            ['nome_produto' => 'Batata com Cheddar e Bacon', 'descricao' => 'Batata frita coberta com cheddar cremoso e bacon', 'preco_atual' => 22.90, 'tipo_produto' => 'Porção', 'ativo' => true],
            ['nome_produto' => 'Onion Rings', 'descricao' => 'Anéis de cebola empanados e fritos', 'preco_atual' => 16.90, 'tipo_produto' => 'Porção', 'ativo' => true],
            ['nome_produto' => 'Frango a Passarinho', 'descricao' => 'Porção de frango temperado e frito', 'preco_atual' => 26.90, 'tipo_produto' => 'Porção', 'ativo' => true],
            ['nome_produto' => 'Polenta Frita', 'descricao' => 'Porção de polenta frita crocante por fora', 'preco_atual' => 15.90, 'tipo_produto' => 'Porção', 'ativo' => true],
            ['nome_produto' => 'Coca-Cola Lata', 'descricao' => 'Refrigerante 350ml', 'preco_atual' => 6.00, 'tipo_produto' => 'Bebida', 'ativo' => true],
            ['nome_produto' => 'Guaraná Antarctica Lata', 'descricao' => 'Refrigerante 350ml', 'preco_atual' => 6.00, 'tipo_produto' => 'Bebida', 'ativo' => true],
            ['nome_produto' => 'Suco Natural de Laranja', 'descricao' => 'Copo 400ml', 'preco_atual' => 8.00, 'tipo_produto' => 'Bebida', 'ativo' => true],
            ['nome_produto' => 'Água Mineral', 'descricao' => 'Garrafa 500ml sem gás', 'preco_atual' => 4.00, 'tipo_produto' => 'Bebida', 'ativo' => true],
            ['nome_produto' => 'Milkshake de Chocolate', 'descricao' => 'Copo 400ml', 'preco_atual' => 12.90, 'tipo_produto' => 'Bebida', 'ativo' => true],
        ];
 
        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}