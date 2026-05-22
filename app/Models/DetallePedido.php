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

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function getProductoNombreAttribute()
    {
        return $this->producto ? $this->producto->nombre : 'Producto Eliminado';
    }
}
