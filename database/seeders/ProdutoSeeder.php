<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produto')->insert([
            [
                'nome_produto' => 'Hambúrguer Clássico',
                'descricao' => 'Pão, carne, queijo e alface',
                'preco_atual' => 18.90,
                'tipo_produto' => 'Lanche',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome_produto' => 'Refrigerante Lata',
                'descricao' => 'Coca-Cola 350ml',
                'preco_atual' => 6.50,
                'tipo_produto' => 'Bebida',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome_produto' => 'Batata Frita',
                'descricao' => 'Porção média de batata frita',
                'preco_atual' => 12.00,
                'tipo_produto' => 'Porção',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome_produto' => 'Suco Natural',
                'descricao' => 'Suco de laranja 500ml',
                'preco_atual' => 8.00,
                'tipo_produto' => 'Bebida',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}