<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'descricao' => $this->faker->sentence(),
            'quantidade_estoque' => rand(10, 100),
            'preco_compra' => $this->faker->randomFloat(2, 50, 500),
            'preco_venda' => $this->faker->randomFloat(2, 100, 1000),
            'categoria_id' => rand(1, 3), // Assumindo que você tenha 3 categorias no seed
            'user_id' => 1,  // Supondo que o usuário autenticado tenha o ID 1
        ];
    }
}
