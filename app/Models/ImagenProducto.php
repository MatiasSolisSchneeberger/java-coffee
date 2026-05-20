<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    protected $fillable = ['url', 'producto_id'];

    // Relación muchos a uno: muchas imágenes pertenecen a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
