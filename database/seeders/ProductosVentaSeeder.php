<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosVentaSeeder extends Seeder
{
    public function run(): void
    {
        $platos = [
            // Platos Fuertes
            [
                'nombre'      => 'Bandeja Paisa Tradicional',
                'descripcion' => 'Frijoles, arroz, carne molida, chicharrón crocante, huevo frito, tajada de plátano, arepa y aguacate.',
                'categoria'   => 'Platos Fuertes',
                'precio'      => 32000,
                'disponible'  => true,
            ],
            [
                'nombre'      => 'Ajiaco Santafereño',
                'descripcion' => 'Sopa típica con tres tipos de papa, pollo desmechado, mazorca, servido con alcaparras, crema de leche y aguacate.',
                'categoria'   => 'Platos Fuertes',
                'precio'      => 28000,
                'disponible'  => true,
            ],
            [
                'nombre'      => 'Sancocho de Gallina Criolla',
                'descripcion' => 'Reconfortante sancocho con gallina de campo, plátano verde, yuca, papa y mazorca, acompañado de arroz y aguacate.',
                'categoria'   => 'Platos Fuertes',
                'precio'      => 30000,
                'disponible'  => true,
            ],
            [
                'nombre'      => 'Chuleta Valluna',
                'descripcion' => 'Lomo de cerdo apanado extra crocante servido con papas a la francesa, arroz blanco y ensalada fresca.',
                'categoria'   => 'Platos Fuertes',
                'precio'      => 26000,
                'disponible'  => true,
            ],
            [
                'nombre'      => 'Sobrebarriga en Salsa Criolla',
                'descripcion' => 'Tierna sobrebarriga bañada en hogao tradicional con papa y yuca al vapor, acompañada de arroz.',
                'categoria'   => 'Platos Fuertes',
                'precio'      => 29000,
                'disponible'  => true,
            ],

            // Entradas
            [
                'nombre'      => 'Porción de Empanadas Caseras (4 uds)',
                'descripcion' => 'Empanadas de carne y papa con ají casero y limón.',
                'categoria'   => 'Entradas',
                'precio'      => 12000,
                'disponible'  => true,
            ],
            [
                'nombre'      => 'Patacones con Hogao y Queso',
                'descripcion' => 'Patacones de plátano verde recién fritos con hogao y queso costeño rallado.',
                'categoria'   => 'Entradas',
                'precio'      => 14000,
                'disponible'  => true,
            ],

            // Bebidas
            [
                'nombre'      => 'Limonada de Coco Frappé',
                'descripcion' => 'Refrescante limonada granizada preparada con leche de coco natural.',
                'categoria'   => 'Bebidas',
                'precio'      => 9000,
                'disponible'  => true,
            ],
            [
                'nombre'      => 'Jugo Natural en Agua',
                'descripcion' => 'Frutas frescas del día: Maracuyá, Mora, Mango, Lulo o Guanábana.',
                'categoria'   => 'Bebidas',
                'precio'      => 7000,
                'disponible'  => true,
            ],
            [
                'nombre'      => 'Jugo Natural en Leche',
                'descripcion' => 'Frutas frescas en leche entera cremosa.',
                'categoria'   => 'Bebidas',
                'precio'      => 8500,
                'disponible'  => true,
            ],
            [
                'nombre'      => 'Gaseosa 400ml',
                'descripcion' => 'Coca-Cola, Postobón Manzana, Colombiana o Cuatro.',
                'categoria'   => 'Bebidas',
                'precio'      => 5000,
                'disponible'  => true,
            ],

            // Postres
            [
                'nombre'      => 'Postre de Natas Casero',
                'descripcion' => 'Elaborado artesanalmente con uvas pasas y canela.',
                'categoria'   => 'Postres',
                'precio'      => 10000,
                'disponible'  => true,
            ],
            [
                'nombre'      => 'Cuajada con Melado',
                'descripcion' => 'Cuajada fresca de finca bañada en melado caliente de panela.',
                'categoria'   => 'Postres',
                'precio'      => 9500,
                'disponible'  => true,
            ],
        ];

        foreach ($platos as $plato) {
            DB::table('productos_venta')->updateOrInsert(
                ['nombre' => $plato['nombre']],
                array_merge($plato, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        $this->command->info('✅ Menú de platos y bebidas poblado exitosamente.');
    }
}
