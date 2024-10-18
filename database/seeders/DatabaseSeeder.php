<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            ProdutoSeeder::class,
            ClienteSeeder::class,
            PagamentoSeeder::class,
            CategoriaSeeder::class,
            VendaSeeder::class,
        ]);
    }
}
