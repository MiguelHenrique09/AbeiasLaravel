<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoPedido extends Model
{
    protected $table = 'produto_pedido';

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        'pedido_idPedido',
        'produto_idProduto',
        'quantidade',
        'preco_unitario',
    ];

    protected $casts = [
        'quantidade' => 'integer',
        'preco_unitario' => 'decimal:2',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_idPedido', 'idPedido');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_idProduto', 'idProduto');
    }
}