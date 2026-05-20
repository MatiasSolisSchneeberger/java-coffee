<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            'nombre' => 'Admin',
            'apellido' => 'Principal',
            'email' => 'admin@javacoffee.com',
            'password' => Hash::make('admin123'),
            'telefono' => '123456789',
            'direccion' => 'Calle Falsa 123',
            'rol' => 'admin'
        ]);

        Usuario::create([
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'juan@cliente.com',
            'password' => Hash::make('cliente123'),
            'telefono' => '987654321',
            'direccion' => 'Avenida Siempreviva 742',
            'rol' => 'cliente'
        ]);
    }
}
