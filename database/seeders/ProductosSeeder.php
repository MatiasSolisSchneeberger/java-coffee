<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Origen;
use App\Models\ImagenProducto;

class ProductosSeeder extends Seeder
{
    /**
     * Ejecuta las semillas de la base de datos.
     */
    public function run(): void
    {
        // 1. Sembrar Orígenes
        $origenes = [
            'Colombia' => 'Café suave con aroma pronunciado, acidez media-alta y cuerpo medio.',
            'Brasil' => 'Café con cuerpo pronunciado, baja acidez y notas dulces a chocolate o nuez.',
            'Etiopía' => 'Café con acidez cítrica brillante, notas florales muy aromáticas y frutales.',
            'Honduras' => 'Café equilibrado con acidez cítrica media y notas de caramelo y chocolate.',
            'Kenia' => 'Café de acidez vinosa brillante, cuerpo medio y marcados sabores frutales.',
            'Blend' => 'Mezcla balanceada de granos de diversos orígenes seleccionados.',
        ];

        $origenIds = [];
        foreach ($origenes as $nombre => $descripcion) {
            $origen = Origen::firstOrCreate([
                'nombre' => $nombre
            ], [
                'descripcion' => $descripcion
            ]);
            $origenIds[$nombre] = $origen->id;
        }

        // 2. Sembrar Categorías
        $categorias = [
            'Café en Grano' => 'Granos de café seleccionados de los mejores orígenes, listos para moler.',
            'Cápsulas' => 'Cápsulas compatibles con sistemas express para una taza rápida y perfecta.',
            'Molido' => 'Café molido con el grosor ideal para filtro, prensa o espresso.',
            'Descafeinado' => 'Todo el aroma y sabor del buen café, libre de cafeína.'
        ];

        $categoriaIds = [];
        foreach ($categorias as $nombre => $descripcion) {
            $categoria = Categoria::firstOrCreate([
                'nombre' => $nombre
            ], [
                'descripcion' => $descripcion
            ]);
            $categoriaIds[$nombre] = $categoria->id;
        }

        // 3. Productos del JSON
        $json = <<<JSON
{
    "productos": [
        {
            "nombre": "Java Jolt",
            "descripcion": "Un café robusto con notas de chocolate oscuro, diseñado para largas sesiones de debugging.",
            "precio": 15.50,
            "oferta": 12.00,
            "tipo": "Café en Grano",
            "origen": "Colombia",
            "tueste": "Grano entero",
            "imagenes": ["java-jolt-1.png", "java-jolt-2.png", "java-jolt-3.png"]
        },
        {
            "nombre": "Python Pour-over",
            "descripcion": "Sabor suave y versátil, con baja acidez para una lectura de logs sin interrupciones.",
            "precio": 18.00,
            "tipo": "Molido",
            "origen": "Brasil",
            "tueste": "Molido fino",
            "imagenes": ["python-pour-over-1.png", "python-pour-over-2.png", "python-pour-over-3.png"]
        },
        {
            "nombre": "C++ Caffeine",
            "descripcion": "Máximo rendimiento y eficiencia. Una descarga directa de cafeína al sistema central.",
            "precio": 20.00,
            "tipo": "Cápsulas",
            "origen": "Brasil",
            "tueste": "Cápsulas",
            "imagenes": ["cpp-caffeine-1.png", "cpp-caffeine-2.png", "cpp-caffeine-3.png"]
        },
        {
            "nombre": "Binary Brew",
            "descripcion": "El café para cuando solo tienes dos estados: despierto o dormido.",
            "precio": 10.00,
            "tipo": "Molido",
            "origen": "Brasil",
            "tueste": "Instantáneo"
        },
        {
            "nombre": "Ruby Roast",
            "descripcion": "Elegante y con cuerpo. Un tueste medio optimizado para la productividad.",
            "precio": 22.00,
            "tipo": "Café en Grano",
            "origen": "Etiopía",
            "tueste": "Grano entero"
        },
        {
            "nombre": "Overflow Espresso",
            "descripcion": "Advertencia: Puede causar un exceso de energía. Tueste intenso para proyectos críticos.",
            "precio": 14.00,
            "oferta": 10.50,
            "tipo": "Molido",
            "origen": "Brasil",
            "tueste": "Molido medio"
        },
        {
            "nombre": "Null Pointer Nectar",
            "descripcion": "Tan puro que no encontrarás errores en su sabor. Filtrado a la perfección.",
            "precio": 16.50,
            "tipo": "Molido",
            "origen": "Etiopía",
            "tueste": "Cold Brew"
        },
        {
            "nombre": "Async Arabica",
            "descripcion": "El sabor llega justo a tiempo, sin bloquear tus procesos mentales.",
            "precio": 19.00,
            "tipo": "Café en Grano",
            "origen": "Colombia",
            "tueste": "Grano entero"
        },
        {
            "nombre": "Recursive Roast",
            "descripcion": "Un sabor que se profundiza en cada iteración. Notas de caramelo y madera.",
            "precio": 21.00,
            "tipo": "Molido",
            "origen": "Blend",
            "tueste": "Molido fino"
        },
        {
            "nombre": "Stack Trace Stout",
            "descripcion": "Café denso y oscuro para rastrear el origen de cualquier bug matutino.",
            "precio": 13.00,
            "tipo": "Molido",
            "origen": "Blend",
            "tueste": "Granulado"
        },
        {
            "nombre": "Docker Dark Roast",
            "descripcion": "Empaquetado a la perfección. Funciona igual de bien en cualquier taza o entorno.",
            "precio": 17.00,
            "tipo": "Café en Grano",
            "origen": "Blend",
            "tueste": "Grano entero"
        },
        {
            "nombre": "JavaScript Juice",
            "descripcion": "Para los creadores web. A veces impredecible, pero absolutamente necesario para el front-end.",
            "precio": 16.00,
            "tipo": "Cápsulas",
            "origen": "Blend",
            "tueste": "Cápsulas"
        },
        {
            "nombre": "Git Grind",
            "descripcion": "Guarda tu estado actual y haz un commit a tu energía matutina con esta mezcla balanceada.",
            "precio": 14.50,
            "tipo": "Molido",
            "origen": "Blend",
            "tueste": "Molido medio"
        },
        {
            "nombre": "SQL Shot",
            "descripcion": "Consulta tus reservas de energía y extrae exactamente lo que necesitas para seguir operando.",
            "precio": 12.00,
            "tipo": "Molido",
            "origen": "Blend",
            "tueste": "Instantáneo"
        },
        {
            "nombre": "Linux Latte",
            "descripcion": "Completamente open source. Tú decides cuánta leche y azúcar compilar en él.",
            "precio": 18.50,
            "tipo": "Molido",
            "origen": "Blend",
            "tueste": "Molido fino"
        },
        {
            "nombre": "CSS Cappuccino",
            "descripcion": "Todo sobre la presentación. Una capa perfecta de espuma que estiliza tu mañana.",
            "precio": 19.00,
            "oferta": 15.00,
            "tipo": "Molido",
            "origen": "Blend",
            "tueste": "Granulado"
        },
        {
            "nombre": "React Ristretto",
            "descripcion": "Corto, intenso y reactivo a tus necesidades inmediatas de concentración.",
            "precio": 21.50,
            "tipo": "Cápsulas",
            "origen": "Blend",
            "tueste": "Cápsulas"
        },
        {
            "nombre": "Go Grind",
            "descripcion": "Alta concurrencia en tu sistema nervioso. Tueste claro para una ejecución rápida.",
            "precio": 15.00,
            "tipo": "Café en Grano",
            "origen": "Honduras",
            "tueste": "Grano entero"
        },
        {
            "nombre": "Cloud Computing Cold Brew",
            "descripcion": "Servido en la nube, frío y listo para escalar según tus exigencias de la tarde.",
            "precio": 17.50,
            "tipo": "Molido",
            "origen": "Blend",
            "tueste": "Cold Brew"
        },
        {
            "nombre": "Malware Macchiato",
            "descripcion": "Una deliciosa infección de caramelo y chocolate que tomará control de tu paladar.",
            "precio": 23.00,
            "tipo": "Molido",
            "origen": "Blend",
            "tueste": "Molido medio"
        }
    ]
}
JSON;

        $data = json_decode($json, true);

        if (isset($data['productos'])) {
            foreach ($data['productos'] as $prodData) {
                $producto = Producto::create([
                    'categoria_id' => $categoriaIds[$prodData['tipo']] ?? $categoriaIds['Café en Grano'],
                    'nombre' => $prodData['nombre'],
                    'descripcion' => $prodData['descripcion'] ?? '',
                    'precio' => $prodData['precio'],
                    'oferta' => $prodData['oferta'] ?? null,
                    'stock' => rand(15, 60),
                    'origen_id' => $origenIds[$prodData['origen']] ?? $origenIds['Blend'],
                    'tueste' => $prodData['tueste'] ?? 'Desconocido',
                    'peso_gramos' => 250,
                    'estado' => 'activo'
                ]);

                if (isset($prodData['imagenes']) && is_array($prodData['imagenes'])) {
                    foreach ($prodData['imagenes'] as $imagen) {
                        ImagenProducto::create([
                            'producto_id' => $producto->id,
                            'url' => $imagen
                        ]);
                    }
                } else {
                    ImagenProducto::create([
                        'producto_id' => $producto->id,
                        'url' => 'error-404.png'
                    ]);
                }
            }
        }

        // 4. Sembrar PRODUCTOS NUEVOS (Sin Stock, Inactivos, Descafeinados)
        $nuevosProductos = [
            [
                'nombre' => 'Café de Especialidad Kenia AA',
                'categoria' => 'Café en Grano',
                'descripcion' => 'Excepcional café de la región de Nyeri. Notas de frutos del bosque, acidez cítrica brillante y cuerpo sedoso. De los granos más cotizados de África.',
                'precio' => 24.50,
                'stock' => 0, // Sin stock!
                'origen' => 'Kenia',
                'tueste' => 'Grano entero',
                'peso' => 250,
                'estado' => 'activo',
                'imagenes' => ['error-404.png']
            ],
            [
                'nombre' => 'Edición Limitada Kona Hawái',
                'categoria' => 'Café en Grano',
                'descripcion' => 'Granos extremadamente exclusivos cultivados en suelo volcánico en las laderas de Hawái. Perfil de sabor dulce con toques de nuez y flores. Próximamente disponible.',
                'precio' => 35.00,
                'stock' => 15,
                'origen' => 'Blend',
                'tueste' => 'Grano entero',
                'peso' => 250,
                'estado' => 'inactivo', // No a la venta!
                'imagenes' => ['error-404.png']
            ],
            [
                'nombre' => 'Decaf Debugger Blend',
                'categoria' => 'Descafeinado',
                'descripcion' => 'Café de especialidad descafeinado mediante proceso al agua natural. Mantiene todo el cuerpo y notas acarameladas del café de origen colombiano.',
                'precio' => 16.00,
                'oferta' => 13.50,
                'stock' => 45,
                'origen' => 'Colombia',
                'tueste' => 'Molido medio',
                'peso' => 250,
                'estado' => 'activo',
                'imagenes' => ['error-404.png']
            ],
            [
                'nombre' => 'Cápsulas Decaf Coffee',
                'categoria' => 'Descafeinado',
                'descripcion' => 'Tus cápsulas favoritas compatibles con cafeteras express en su versión descafeinada. Sabor balanceado y excelente crema.',
                'precio' => 18.50,
                'stock' => 30,
                'origen' => 'Brasil',
                'tueste' => 'Cápsulas',
                'peso' => 120,
                'estado' => 'activo',
                'imagenes' => ['cpp-caffeine-1.png']
            ],
            [
                'nombre' => 'Café Colombia Bourbon Amarillo',
                'categoria' => 'Café en Grano',
                'descripcion' => 'Café de especialidad cultivado a más de 1800 msnm. Proceso natural con fermentación controlada que resalta notas de frutos amarillos y chocolate con leche.',
                'precio' => 22.50,
                'stock' => 24,
                'origen' => 'Colombia',
                'tueste' => 'Grano entero',
                'peso' => 250,
                'estado' => 'activo',
                'imagenes' => ['java-jolt-1.png', 'java-jolt-2.png']
            ]
        ];

        foreach ($nuevosProductos as $prod) {
            $producto = Producto::create([
                'categoria_id' => $categoriaIds[$prod['categoria']],
                'nombre' => $prod['nombre'],
                'descripcion' => $prod['descripcion'],
                'precio' => $prod['precio'],
                'oferta' => $prod['oferta'] ?? null,
                'stock' => $prod['stock'],
                'origen_id' => $origenIds[$prod['origen']],
                'tueste' => $prod['tueste'],
                'peso_gramos' => $prod['peso'],
                'estado' => $prod['estado']
            ]);

            foreach ($prod['imagenes'] as $img) {
                ImagenProducto::create([
                    'producto_id' => $producto->id,
                    'url' => $img
                ]);
            }
        }
    }
}
