<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'usuario_id', 'estado', 'total', 'metodo_pago', 'direccion_envio'
    ];

    protected $casts = [
        'total' => 'decimal:2'
    ];
}
