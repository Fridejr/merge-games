<?php

namespace Database\Seeders;

use App\Models\Tablero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablerosConsolasSeeder extends Seeder
{
    public function run(): void
    {
        //crear tablero para el usuario de id 3
        DB::table('tableros_consolas')->insert([
            [
                'tablero_id' => 1,
                'consola_id' => 20,
                'posicion' => 1
            ],
            [
                'tablero_id' => 1,
                'consola_id' => 19,
                'posicion' => 2
            ],
            [
                'tablero_id' => 1,
                'consola_id' => 18,
                'posicion' => 3
            ],
            [
                'tablero_id' => 1,
                'consola_id' => 17,
                'posicion' => 4
            ],
            [
                'tablero_id' => 1,
                'consola_id' => 16,
                'posicion' => 5
            ],
            [
                'tablero_id' => 1,
                'consola_id' => 15,
                'posicion' => 6
            ],
            [
                'tablero_id' => 1,
                'consola_id' => 14,
                'posicion' => 7
            ],
            [
                'tablero_id' => 1,
                'consola_id' => 14,
                'posicion' => 8
            ]
        ]);
    }
}