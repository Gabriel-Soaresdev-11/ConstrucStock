<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['produto_id', 'cliente_id', 'user_id', 'quantidade', 'data_venda', 'valor_total', 'status_pagamento', 'metodo_pagamento'];

    // Garantir que 'data_venda' seja tratada como data
    protected $dates = ['data_venda'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relacionamento: uma venda pertence a um usuário (quem fez a venda)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
