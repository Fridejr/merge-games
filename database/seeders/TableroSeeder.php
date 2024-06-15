<?php

namespace Database\Seeders;

use App\Models\Tablero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //crear tablero para el usuario de id 3
        DB::table('tableros')->insert([
            'user_id' => 3,
            'created_at' => now(),
        ]);
    }
}
