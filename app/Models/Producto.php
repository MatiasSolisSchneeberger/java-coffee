<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
   protected $fillable = [
        'categoria_id', 'nombre', 'descripcion', 'precio', 'stock', 
        'origen', 'tueste', 'peso_gramos', 'estado'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'peso_gramos' => 'integer'
    ];
}
