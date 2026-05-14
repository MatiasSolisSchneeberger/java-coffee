<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCarrito extends Model
{
    protected $fillable = ['carrito_id', 'producto_id', 'cantidad'];

    protected $casts = [
        'cantidad' => 'integer'
    ];
}
