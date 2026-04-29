<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Produto;

class Pedido extends Model
{
    use SoftDeletes;

    protected $table = 'pedido';
    protected $primaryKey = 'idPedido';

    protected $fillable = [
        'data_hora_pedido',
        'valor_total',
        'observacoes',
        'user_id',
        'statusPedido',
        'endereco'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produtos()
    {
        return $this->belongsToMany(
            Produto::class,
            'produto_pedido',
            'pedido_idPedido',
            'produto_idProduto'
        )->withPivot('quantidade', 'preco_unitario');
    }
}