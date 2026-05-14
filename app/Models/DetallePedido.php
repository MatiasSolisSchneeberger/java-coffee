<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
  protected $fillable = [
        'pedido_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal'
    ];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'cantidad' => 'integer'
    ];
}
