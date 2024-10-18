<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;
    protected $table = 'pagamentos';

    protected $fillable = [
        'venda_id',
        'data_pagamento',
        'valor_pagamento',
        'metodo_pagamento',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
