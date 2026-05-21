<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = ['usuario_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function items()
    {
        return $this->hasMany(ItemCarrito::class, 'carrito_id');
    }

    public static function getCartCount()
    {
        if (auth()->check()) {
            $carrito = self::where('usuario_id', auth()->id())->first();
            return $carrito ? $carrito->items()->sum('cantidad') : 0;
        }
        return 0;
    }
}
