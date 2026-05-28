<?php

namespace Database\Seeders;

use App\Models\Carrito;
use App\Models\Comentario;
use App\Models\Consulta;
use App\Models\DetallePedido;
use App\Models\ItemCarrito;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\ProductoFavorito;
use App\Models\Provincia;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Sembrar Provincias de Argentina
        $provinciasNombres = [
            'Buenos Aires',
            'Ciudad Autónoma de Buenos Aires',
            'Córdoba',
            'Santa Fe',
            'Mendoza',
            'Tucumán',
            'Entre Ríos',
            'Salta',
            'Neuquén',
            'Río Negro',
            'Misiones',
            'Chaco',
            'Corrientes',
            'Santiago del Estero',
            'San Juan',
            'Jujuy',
            'Chubut',
            'Formosa',
            'San Luis',
            'Catamarca',
            'La Rioja',
            'La Pampa',
            'Santa Cruz',
            'Tierra del Fuego',
        ];

        $provinciaIds = [];
        foreach ($provinciasNombres as $nombre) {
            $prov = Provincia::firstOrCreate(['nombre' => $nombre]);
            $provinciaIds[$nombre] = $prov->id;
        }

        // 2. Sembrar Usuarios
        // Admin
        $admin = Usuario::firstOrCreate([
            'nombre' => 'Admin',
            'apellido' => 'Principal',
            'email' => 'admin@javacoffee.com',
            'password' => Hash::make('admin123'),
            'telefono' => '1133445566',
            'direccion' => 'Av. Corrientes 1234',
            'provincia_id' => $provinciaIds['Ciudad Autónoma de Buenos Aires'],
            'rol' => 'admin',
        ]);

        // Juan (Cliente común con carrito y favoritos)
        $juan = Usuario::firstOrCreate([
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'email' => 'juan@cliente.com',
            'password' => Hash::make('cliente123'),
            'telefono' => '351987654',
            'direccion' => 'Av. Colón 450',
            'provincia_id' => $provinciaIds['Córdoba'],
            'rol' => 'cliente',
        ]);

        // Ana (Cliente con Pedidos)
        $ana = Usuario::firstOrCreate([
            'nombre' => 'Ana',
            'apellido' => 'Martínez',
            'email' => 'ana.pedidos@cliente.com',
            'password' => Hash::make('cliente123'),
            'telefono' => '341654321',
            'direccion' => 'Bv. Oroño 1420',
            'provincia_id' => $provinciaIds['Santa Fe'],
            'rol' => 'cliente',
        ]);

        // Pedro (Cliente con Comentarios)
        $pedro = Usuario::firstOrCreate([
            'nombre' => 'Pedro',
            'apellido' => 'González',
            'email' => 'pedro.comentarios@cliente.com',
            'password' => Hash::make('cliente123'),
            'telefono' => '261555666',
            'direccion' => 'Aristides Villanueva 320',
            'provincia_id' => $provinciaIds['Mendoza'],
            'rol' => 'cliente',
        ]);

        // Lucía (Cliente con Consultas/Mensajes)
        $lucia = Usuario::firstOrCreate([
            'nombre' => 'Lucía',
            'apellido' => 'Fernández',
            'email' => 'lucia.consultas@cliente.com',
            'password' => Hash::make('cliente123'),
            'telefono' => '381444332',
            'direccion' => 'Calle 25 de Mayo 150',
            'provincia_id' => $provinciaIds['Tucumán'],
            'rol' => 'cliente',
        ]);

        // 3. Sembrar Consultas de Contacto (Inquiries)
        // Consulta 1 de Lucía (Respondida)
        Consulta::create([
            'usuario_id' => $lucia->id,
            'nombre' => 'Lucía Fernández',
            'email' => 'lucia.consultas@cliente.com',
            'asunto' => 'Consulta sobre envíos al interior',
            'mensaje' => 'Hola, buenas tardes. Quería saber si realizan envíos de café en grano a la provincia de Tucumán y cuál es el costo aproximado por un pedido de 2 kilos. Muchas gracias.',
            'estado' => 'respondido',
            'respuesta' => 'Hola Lucía, ¿cómo estás? Sí, realizamos envíos a todo el país a través de Correo Argentino y Andreani. El costo depende de la localidad pero ronda los $3500 por 2kg. Saludos!',
        ]);

        // Consulta 2 de Lucía (Pendiente/No leída)
        Consulta::create([
            'usuario_id' => $lucia->id,
            'nombre' => 'Lucía Fernández',
            'email' => 'lucia.consultas@cliente.com',
            'asunto' => 'Demora en acreditación de pago',
            'mensaje' => 'Hola, realicé una transferencia bancaria para el pedido #2 pero todavía figura como pendiente. Les adjunté el comprobante por correo. Saludos.',
            'estado' => 'no leido',
            'respuesta' => null,
        ]);

        // Consulta 3 Anónima (No leída)
        Consulta::create([
            'usuario_id' => null, // Anónima
            'nombre' => 'Carlos López',
            'email' => 'carlos.lopez@externo.com',
            'asunto' => 'Venta mayorista para cafeterías',
            'mensaje' => 'Buenas, tengo una cafetería de especialidad en Neuquén y me gustaría cotizar la compra mensual de 20kg de café en grano (distintos orígenes). ¿Tienen precios de distribuidor?',
            'estado' => 'no leido',
            'respuesta' => null,
        ]);

        // 4. Sembrar Comentarios en Productos
        $javaJolt = Producto::where('nombre', 'Java Jolt')->first();
        $pythonPour = Producto::where('nombre', 'Python Pour-over')->first();
        $cppCaffeine = Producto::where('nombre', 'C++ Caffeine')->first();
        $binaryBrew = Producto::where('nombre', 'Binary Brew')->first();
        $keniaAA = Producto::where('nombre', 'Café de Especialidad Kenia AA')->first();

        // Comentarios Aprobados (visibles al público)
        if ($javaJolt) {
            Comentario::create([
                'producto_id' => $javaJolt->id,
                'usuario_id' => $pedro->id,
                'calificacion' => 5,
                'comentario' => 'El mejor café de especialidad que probé en Buenos Aires. Tostado ideal y gran cuerpo para programar.',
                'estado' => 'aprobado',
            ]);

            Comentario::create([
                'producto_id' => $javaJolt->id,
                'usuario_id' => $juan->id,
                'calificacion' => 4,
                'comentario' => 'Sabor a chocolate y frutos secos muy marcado. Muy recomendado.',
                'estado' => 'aprobado',
            ]);
        }

        if ($pythonPour) {
            Comentario::create([
                'producto_id' => $pythonPour->id,
                'usuario_id' => $juan->id,
                'calificacion' => 5,
                'comentario' => 'Sabor suave y versátil. Su acidez baja es perfecta para arrancar las mañanas.',
                'estado' => 'aprobado',
            ]);
        }

        // Comentario Pendiente (esperando moderación)
        if ($cppCaffeine) {
            Comentario::create([
                'producto_id' => $cppCaffeine->id,
                'usuario_id' => $pedro->id,
                'calificacion' => 3,
                'comentario' => 'El café tiene un sabor excelente y mucha fuerza, pero el empaque llegó algo golpeado en el envío. Deberían proteger mejor los paquetes.',
                'estado' => 'pendiente',
            ]);
        }

        // Comentario Rechazado/Baneado (no visible al público en el detalle)
        if ($binaryBrew) {
            Comentario::create([
                'producto_id' => $binaryBrew->id,
                'usuario_id' => $pedro->id,
                'calificacion' => 1,
                'comentario' => 'Este café es horrible, sabe a plástico quemado y el envío tardó 3 semanas. Estafa total, no compren acá.',
                'estado' => 'rechazado',
            ]);
        }

        // 5. Sembrar Pedidos y Detalles de Pedido
        if ($javaJolt && $pythonPour && $cppCaffeine && $binaryBrew) {
            // Pedido 1 (Pendiente) para Ana
            $pedido1 = Pedido::create([
                'usuario_id' => $ana->id,
                'provincia_id' => $provinciaIds['Santa Fe'],
                'estado' => 'pendiente',
                'total' => ($javaJolt->precio * 2) + $pythonPour->precio,
                'metodo_pago' => 'Tarjeta',
                'direccion_envio' => 'Bv. Oroño 1420, Piso 3A',
            ]);

            DetallePedido::create([
                'pedido_id' => $pedido1->id,
                'producto_id' => $javaJolt->id,
                'cantidad' => 2,
                'precio_unitario' => $javaJolt->precio,
                'subtotal' => $javaJolt->precio * 2,
            ]);

            DetallePedido::create([
                'pedido_id' => $pedido1->id,
                'producto_id' => $pythonPour->id,
                'cantidad' => 1,
                'precio_unitario' => $pythonPour->precio,
                'subtotal' => $pythonPour->precio,
            ]);

            // Pedido 2 (Entregado / Completado) para Ana
            $pedido2 = Pedido::create([
                'usuario_id' => $ana->id,
                'provincia_id' => $provinciaIds['Santa Fe'],
                'estado' => 'entregado',
                'total' => $cppCaffeine->precio * 3,
                'metodo_pago' => 'Transferencia',
                'direccion_envio' => 'Bv. Oroño 1420, Piso 3A',
            ]);

            DetallePedido::create([
                'pedido_id' => $pedido2->id,
                'producto_id' => $cppCaffeine->id,
                'cantidad' => 3,
                'precio_unitario' => $cppCaffeine->precio,
                'subtotal' => $cppCaffeine->precio * 3,
            ]);

            // Pedido 3 (Cancelado) para Ana
            $pedido3 = Pedido::create([
                'usuario_id' => $ana->id,
                'provincia_id' => $provinciaIds['Santa Fe'],
                'estado' => 'cancelado',
                'total' => $binaryBrew->precio * 5,
                'metodo_pago' => 'Efectivo',
                'direccion_envio' => 'Bv. Oroño 1420, Piso 3A',
            ]);

            DetallePedido::create([
                'pedido_id' => $pedido3->id,
                'producto_id' => $binaryBrew->id,
                'cantidad' => 5,
                'precio_unitario' => $binaryBrew->precio,
                'subtotal' => $binaryBrew->precio * 5,
            ]);
        }

        // 6. Sembrar Favoritos
        if ($javaJolt && $pythonPour) {
            ProductoFavorito::create([
                'usuario_id' => $juan->id,
                'producto_id' => $javaJolt->id,
            ]);

            ProductoFavorito::create([
                'usuario_id' => $juan->id,
                'producto_id' => $pythonPour->id,
            ]);
        }

        if ($cppCaffeine) {
            ProductoFavorito::create([
                'usuario_id' => $ana->id,
                'producto_id' => $cppCaffeine->id,
            ]);
        }

        // 7. Sembrar Carritos y sus Items
        // Carrito para Juan
        $carritoJuan = Carrito::create(['usuario_id' => $juan->id]);
        if ($javaJolt) {
            ItemCarrito::create([
                'carrito_id' => $carritoJuan->id,
                'producto_id' => $javaJolt->id,
                'cantidad' => 2,
            ]);
        }

        // Carrito para Ana
        $carritoAna = Carrito::create(['usuario_id' => $ana->id]);
        if ($pythonPour) {
            ItemCarrito::create([
                'carrito_id' => $carritoAna->id,
                'producto_id' => $pythonPour->id,
                'cantidad' => 1,
            ]);
        }
    }
}
