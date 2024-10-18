<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create(['nome' => 'Ferramentas', 'descricao' => 'Ferramentas para construção', 'user_id' => 1]);
        Categoria::create(['nome' => 'Materiais', 'descricao' => 'Materiais de construção diversos', 'user_id' => 1]);
        Categoria::create(['nome' => 'Tijolos', 'descricao' => 'Tijolos e blocos de concreto', 'user_id' => 1]);
    }
}
