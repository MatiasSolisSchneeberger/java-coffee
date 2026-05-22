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

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }

    public function getFechaAttribute()
    {
        return $this->created_at;
    }
}
