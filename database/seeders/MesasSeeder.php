<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesasSeeder extends Seeder
{
    public function run(): void
    {
        // Solo insertar si no existen mesas
        if (DB::table('mesas')->count() > 0) {
            $this->command->info('Ya existen mesas en la base de datos. Seeder omitido.');
            return;
        }

        DB::table('mesas')->insert([
            ['numero' => 'Mesa 1',   'capacidad' => 2, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
            ['numero' => 'Mesa 2',   'capacidad' => 4, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
            ['numero' => 'Mesa 3',   'capacidad' => 4, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
            ['numero' => 'Mesa 4',   'capacidad' => 4, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
            ['numero' => 'Mesa 5',   'capacidad' => 6, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
            ['numero' => 'Mesa 6',   'capacidad' => 6, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
            ['numero' => 'Mesa 7',   'capacidad' => 8, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
            ['numero' => 'Mesa 8',   'capacidad' => 8, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
            ['numero' => 'Terraza 1','capacidad' => 4, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
            ['numero' => 'Terraza 2','capacidad' => 4, 'estado' => 'Libre', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $this->command->info('✅ 10 mesas creadas correctamente.');
    }
}
