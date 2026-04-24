<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Produto;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // cria usuários
        User::factory(20)->create();

        // chama o seeder de produtos e/ou factoryProdutos
        //$this->call(ProdutoSeeder::class);
     Produto::factory()->count(20)->create();

    }
}