<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoFavorito extends Model
{
   protected $fillable = ['usuario_id', 'producto_id'];

   public function usuario()
   {
       return $this->belongsTo(Usuario::class, 'usuario_id');
   }

   public function producto()
   {
       return $this->belongsTo(Producto::class, 'producto_id');
   }
}
