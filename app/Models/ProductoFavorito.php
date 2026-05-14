<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoFavorito extends Model
{
   protected $fillable = ['usuario_id', 'producto_id'];
}
