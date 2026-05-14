<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'email', 'password', 'telefono', 'direccion', 'rol'
    ];

    protected $hidden = ['password']; // No se muestra en consultas JSON
}
