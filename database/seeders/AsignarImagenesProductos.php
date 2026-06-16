<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\ImagenProducto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AsignarImagenesProductos extends Seeder
{
    /**
     * Ejecuta las semillas de la base de datos.
     */
    public function run(): void
    {
        // Rutas absolutas a las imágenes base del proyecto
        $baseImages = [
            'bag' => 'C:\\Users\\Matia\\.gemini\\antigravity\\brain\\5a436da5-a5d7-468e-804a-c0a6ab7079cd\\coffee_bag_mockup_1780404756645.png',
            'cup' => 'C:\\Users\\Matia\\.gemini\\antigravity\\brain\\5a436da5-a5d7-468e-804a-c0a6ab7079cd\\coffee_cup_latte_1780404771460.png',
            'capsules' => 'C:\\Users\\Matia\\.gemini\\antigravity\\brain\\5a436da5-a5d7-468e-804a-c0a6ab7079cd\\coffee_capsules_1780404791448.png',
            'coldbrew' => 'C:\\Users\\Matia\\.gemini\\antigravity\\brain\\5a436da5-a5d7-468e-804a-c0a6ab7079cd\\coffee_cold_brew_1780404810486.png',
            'beans' => 'C:\\Users\\Matia\\.gemini\\antigravity\\brain\\5a436da5-a5d7-468e-804a-c0a6ab7079cd\\coffee_beans_1780404834665.png',
        ];

        // Verificar que los archivos base existan
        foreach ($baseImages as $key => $path) {
            if (!File::exists($path)) {
                $this->command->error("No se encontró la imagen base para '{$key}' en la ruta: {$path}");
                return;
            }
        }

        $destDir = storage_path('app/public/productos');
        if (!File::exists($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        $productos = Producto::with(['categoria', 'origen'])->get();

        $this->command->info("Procesando " . $productos->count() . " productos...");

        foreach ($productos as $producto) {
            $slug = Str::slug($producto->nombre);
            $categoriaNombre = $producto->categoria ? $producto->categoria->nombre : '';

            // Definir qué imagen base usar como primera, segunda y tercera
            // según la categoría y presentación
            if (Str::contains(strtolower($categoriaNombre), 'cápsula') || Str::contains(strtolower($producto->tueste), 'cápsula')) {
                $mapped = ['capsules', 'cup', 'bag'];
            } elseif (Str::contains(strtolower($categoriaNombre), 'descafeinado')) {
                $mapped = ['beans', 'cup', 'bag'];
            } elseif (Str::contains(strtolower($categoriaNombre), 'molido') || Str::contains(strtolower($producto->tueste), 'molido')) {
                $mapped = ['cup', 'beans', 'bag'];
            } elseif (Str::contains(strtolower($producto->tueste), 'cold brew') || Str::contains(strtolower($producto->tueste), 'instantáneo')) {
                $mapped = ['coldbrew', 'cup', 'beans'];
            } else {
                // Café en Grano / default
                $mapped = ['bag', 'cup', 'beans'];
            }

            // Eliminar imágenes previas en la base de datos
            $producto->imagenes()->delete();

            // Copiar los archivos físicos y crear registros
            for ($i = 0; $i < 3; $i++) {
                $imageKey = $mapped[$i];
                $srcFile = $baseImages[$imageKey];
                $filename = "{$slug}-" . ($i + 1) . ".png";
                $destFile = $destDir . DIRECTORY_SEPARATOR . $filename;

                // Copiar archivo físico
                File::copy($srcFile, $destFile);

                // Crear registro en base de datos
                ImagenProducto::create([
                    'producto_id' => $producto->id,
                    'url' => $filename
                ]);
            }

            $this->command->info("Imágenes asignadas para: {$producto->nombre}");
        }

        $this->command->info("¡Completado con éxito!");
    }
}
