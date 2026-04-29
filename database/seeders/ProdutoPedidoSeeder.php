<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoPedidoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produto_pedido')->insert([

            [
                'pedido_idPedido' => 1,
                'produto_idProduto' => 1,
                'quantidade' => 2,
                'preco_unitario' => 25.00
            ],

            [
                'pedido_idPedido' => 1,
                'produto_idProduto' => 2,
                'quantidade' => 1,
                'preco_unitario' => 18.50
            ],

            [
                'pedido_idPedido' => 2,
                'produto_idProduto' => 3,
                'quantidade' => 3,
                'preco_unitario' => 12.00
            ],

            [
                'pedido_idPedido' => 2,
                'produto_idProduto' => 4,
                'quantidade' => 2,
                'preco_unitario' => 15.00
            ],

            [
                'pedido_idPedido' => 3,
                'produto_idProduto' => 1,
                'quantidade' => 1,
                'preco_unitario' => 25.00
            ],

            [
                'pedido_idPedido' => 3,
                'produto_idProduto' => 5,
                'quantidade' => 2,
                'preco_unitario' => 10.00
            ],

            [
                'pedido_idPedido' => 4,
                'produto_idProduto' => 2,
                'quantidade' => 4,
                'preco_unitario' => 18.50
            ],

            [
                'pedido_idPedido' => 5,
                'produto_idProduto' => 3,
                'quantidade' => 1,
                'preco_unitario' => 12.00
            ],

            [
                'pedido_idPedido' => 5,
                'produto_idProduto' => 4,
                'quantidade' => 3,
                'preco_unitario' => 15.00
            ],

            [
                'pedido_idPedido' => 6,
                'produto_idProduto' => 1,
                'quantidade' => 2,
                'preco_unitario' => 25.00
            ]

        ]);
    }
}