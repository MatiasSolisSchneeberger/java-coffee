<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias';

    protected $fillable = ['nombre'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'provincia_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'provincia_id');
    }
}
