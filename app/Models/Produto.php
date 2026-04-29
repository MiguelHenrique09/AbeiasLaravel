<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{use HasFactory;
    protected $table = 'produto';
    protected $primaryKey = 'idProduto';

    protected $fillable = [
        'nome_produto',
        'preco_atual',
        'ativo'
    ];

    public function pedidos()
    {
        return $this->belongsToMany(
            Pedido::class,
            'produto_pedido',
            'produto_idProduto',
            'pedido_idPedido'
        )->withPivot('quantidade', 'preco_unitario');
    }
}