<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Origen extends Model
{
    protected $table = 'origenes';

    protected $fillable = ['nombre', 'descripcion'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'origen_id');
    }
}
