<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'quantidade_estoque',
        'preco_compra',
        'preco_venda',
        'categoria_id',
        'user_id',
        'data_adicionada'
    ];

     // Definindo o relacionamento: um produto pertence a uma categoria
     public function categoria()
     {
         return $this->belongsTo(Categoria::class);
     }

      // Relacionamento: um produto pertence a um usuário (o criador do produto)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
