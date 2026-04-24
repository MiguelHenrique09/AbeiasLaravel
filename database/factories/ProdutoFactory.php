<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome_produto' => $this->faker->words(2, true),
            'descricao' => $this->faker->sentence(),
            'preco_atual' => $this->faker->randomFloat(2, 5, 50),
            'tipo_produto' => $this->faker->randomElement(['Bebida','Lanche','Porção']),
            'ativo' => $this->faker->boolean(90), // 90% ativos
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}