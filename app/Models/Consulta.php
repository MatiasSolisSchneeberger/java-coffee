<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
   protected $fillable = [
        'usuario_id', 'nombre', 'email', 'asunto', 'mensaje', 'estado', 'respuesta'
    ];

   public function usuario()
   {
       return $this->belongsTo(Usuario::class, 'usuario_id');
   }
}
