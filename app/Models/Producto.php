<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
   protected $fillable = [
        'categoria_id', 'nombre', 'descripcion', 'precio', 'oferta', 'stock', 
        'origen_id', 'tueste', 'peso_gramos', 'estado'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'oferta' => 'decimal:2',
        'stock' => 'integer',
        'peso_gramos' => 'integer'
    ];

    /**
     * Obtiene el precio real actual del producto (con descuento si aplica).
     */
    public function getPrecioActualAttribute()
    {
        return ($this->oferta && $this->oferta > 0) ? $this->oferta : $this->precio;
    }

    public function itemsCarrito()
    {
        return $this->hasMany(ItemCarrito::class, 'producto_id');
    }

    public function origen()
    {
        return $this->belongsTo(Origen::class, 'origen_id');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'producto_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
