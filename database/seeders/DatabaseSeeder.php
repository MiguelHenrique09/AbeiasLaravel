<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Produto;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(20)->create();

        Produto::factory()->count(20)->create();

        $this->call([
            PedidoSeeder::class,
            ProdutoPedidoSeeder::class,
            adminSeeder::class,
        ]);
    }
}