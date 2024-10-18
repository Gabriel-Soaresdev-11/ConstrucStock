<?php

namespace Database\Seeders;

use App\Models\Pagamento;
use App\Models\Venda;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $vendasPagas = Venda::where('status_pagamento', 1)->get();

        foreach ($vendasPagas as $venda) {
            Pagamento::create([
                'venda_id' => $venda->id,
                'data_pagamento' => Carbon::now()->subDays(rand(0, 5)),
                'valor_pagamento' => $venda->valor_total,
                'metodo_pagamento' => $venda->metodo_pagamento,
                'status' => 1,  // Pago
                'user_id' => $venda->user_id,
            ]);
        }
    }
}
