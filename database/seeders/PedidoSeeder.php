<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pedido')->insert([

            [
                'idPedido' => 1,
                'data_hora_pedido' => now(),
                'valor_total' => 68.50,
                'observacoes' => 'Sem cebola',
                'user_id' => 1,
                'statusPedido' => 'Confirmando',
                'endereco' => 'Rua A, 123'
            ],

            [
                'idPedido' => 2,
                'data_hora_pedido' => now(),
                'valor_total' => 54.00,
                'observacoes' => 'Entrega rápida',
                'user_id' => 2,
                'statusPedido' => 'Preparando',
                'endereco' => 'Rua B, 456'
            ],

            [
                'idPedido' => 3,
                'data_hora_pedido' => now(),
                'valor_total' => 25.00,
                'observacoes' => null,
                'user_id' => 3,
                'statusPedido' => 'Pronto',
                'endereco' => 'Rua C, 789'
            ],

            [
                'idPedido' => 4,
                'data_hora_pedido' => now(),
                'valor_total' => 74.00,
                'observacoes' => 'Sem tomate',
                'user_id' => 1,
                'statusPedido' => 'Preparando',
                'endereco' => 'Rua D, 111'
            ],

            [
                'idPedido' => 5,
                'data_hora_pedido' => now(),
                'valor_total' => 57.00,
                'observacoes' => null,
                'user_id' => 2,
                'statusPedido' => 'Confirmando',
                'endereco' => 'Rua E, 222'
            ],

            [
                'idPedido' => 6,
                'data_hora_pedido' => now(),
                'valor_total' => 50.00,
                'observacoes' => 'Trocar refrigerante',
                'user_id' => 3,
                'statusPedido' => 'Pronto',
                'endereco' => 'Rua F, 333'
            ],

            [
                'idPedido' => 7,
                'data_hora_pedido' => now(),
                'valor_total' => 82.90,
                'observacoes' => null,
                'user_id' => 1,
                'statusPedido' => 'Preparando',
                'endereco' => 'Rua G, 444'
            ],

            [
                'idPedido' => 8,
                'data_hora_pedido' => now(),
                'valor_total' => 33.00,
                'observacoes' => 'Sem molho',
                'user_id' => 2,
                'statusPedido' => 'Confirmando',
                'endereco' => 'Rua H, 555'
            ],

            [
                'idPedido' => 9,
                'data_hora_pedido' => now(),
                'valor_total' => 120.00,
                'observacoes' => 'Pedido grande',
                'user_id' => 3,
                'statusPedido' => 'Pronto',
                'endereco' => 'Rua I, 666'
            ],

            [
                'idPedido' => 10,
                'data_hora_pedido' => now(),
                'valor_total' => 41.50,
                'observacoes' => null,
                'user_id' => 1,
                'statusPedido' => 'Confirmando',
                'endereco' => 'Rua J, 777'
            ]

        ]);
    }
}