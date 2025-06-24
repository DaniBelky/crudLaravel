<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['nome_cliente', 'produto_id', 'quantidade'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function getPrecoTotalAttribute()
    {
        if ($this->produto) {
            return $this->quantidade * $this->produto->preco;
        }
        return 0;
    }
}
