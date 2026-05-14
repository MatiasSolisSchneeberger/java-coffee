<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'producto_id',
        'usuario_id',
        'calificacion',
        'comentario',
        'estado',
    ];
}
