<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsolaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('consolas')->insert([
            [
                'nombre' => 'Nintendo Entertainment System (NES)',
                'descripcion' => 'Lanzada en 1983, esta consola revolucionó la industria del videojuego con títulos clásicos como Super Mario Bros y The Legend of Zelda.',
                'ruta_imagen' => 'images/nes.png',
                'money' => 1.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Atari 7800',
                'descripcion' => 'Introducida en 1986, la Atari 7800 fue conocida por su compatibilidad con la biblioteca de juegos del Atari 2600 y sus gráficos mejorados.',
                'ruta_imagen' => 'images/atari.png',
                'money' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo Game Boy',
                'descripcion' => 'Lanzada en 1989, la Game Boy fue la primera consola portátil de éxito, famosa por juegos como Tetris y Pokémon.',
                'ruta_imagen' => 'images/gameboy.png',
                'money' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation',
                'descripcion' => 'Sony revolucionó el mercado con la PlayStation en 1994, que popularizó los juegos en CD-ROM y ofreció títulos icónicos como Final Fantasy VII.',
                'ruta_imagen' => 'images/play1.png',
                'money' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo 64',
                'descripcion' => 'Lanzada en 1996, la Nintendo 64 fue conocida por sus innovaciones en juegos en 3D y títulos legendarios como Super Mario 64 y The Legend of Zelda: Ocarina of Time.',
                'ruta_imagen' => 'images/nintendo64.png',
                'money' => 64,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation 2',
                'descripcion' => 'Lanzada en 2000, la PlayStation 2 es la consola más vendida de todos los tiempos, con una vasta biblioteca de juegos y soporte para DVD.',
                'ruta_imagen' => 'images/play2.png',
                'money' => 130,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo GameCube',
                'descripcion' => 'Introducida en 2001, la GameCube destacó por su diseño compacto y juegos populares como Super Smash Bros. Melee y Metroid Prime.',
                'ruta_imagen' => 'images/gamecube.png',
                'money' => 270,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Microsoft Xbox',
                'descripcion' => 'Lanzada en 2001, la Xbox fue la primera consola de Microsoft, conocida por su potente hardware y juegos como Halo: Combat Evolved.',
                'ruta_imagen' => 'images/xbox.png',
                'money' => 550,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo Game Boy Advance',
                'descripcion' => 'Lanzada en 2001, la Game Boy Advance ofreció gráficos mejorados y una biblioteca de juegos diversa, incluyendo clásicos de Nintendo.',
                'ruta_imagen' => 'images/gameboyadvance.png',
                'money' => 1160,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation Portable (PSP)',
                'descripcion' => 'Introducida en 2004, la PSP permitió jugar juegos de calidad de consola sobre la marcha y tenía capacidades multimedia avanzadas.',
                'ruta_imagen' => 'images/psp.png',
                'money' => 2400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo DS',
                'descripcion' => 'Lanzada en 2004, la DS innovó con su pantalla dual y juegos táctiles, y es conocida por éxitos como Nintendogs y New Super Mario Bros.',
                'ruta_imagen' => 'images/ds.png',
                'money' => 4900,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Xbox 360',
                'descripcion' => 'Lanzada en 2005, la Xbox 360 popularizó los juegos en alta definición y servicios en línea como Xbox Live, con títulos como Gears of War.',
                'ruta_imagen' => 'images/xbox360.png',
                'money' => 9950,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation 3',
                'descripcion' => 'Introducida en 2006, la PlayStation 3 ofreció gráficos avanzados y capacidades de Blu-ray, con una amplia variedad de juegos exclusivos.',
                'ruta_imagen' => 'images/play3.png',
                'money' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo Wii',
                'descripcion' => 'Lanzada en 2006, la Wii innovó con su control de movimiento, atrayendo a un amplio público con juegos como Wii Sports y The Legend of Zelda: Twilight Princess.',
                'ruta_imagen' => 'images/wii.png',
                'money' => 30300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo 3DS',
                'descripcion' => 'Introducida en 2011, la 3DS ofreció gráficos en 3D sin necesidad de gafas especiales, y es famosa por juegos como Animal Crossing: New Leaf.',
                'ruta_imagen' => 'images/3ds.png',
                'money' => 40400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation Vita',
                'descripcion' => 'Lanzada en 2011, la PS Vita fue la sucesora de la PSP, destacando por su pantalla OLED y la posibilidad de jugar títulos de PS4 mediante Remote Play.',
                'ruta_imagen' => 'images/psvita.png',
                'money' => 50500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'PlayStation 4',
                'descripcion' => 'Lanzada en 2013, la PlayStation 4 se convirtió rápidamente en un éxito, con una poderosa combinación de gráficos, juegos exclusivos y servicios en línea.',
                'ruta_imagen' => 'images/play4.png',
                'money' => 60600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Xbox One',
                'descripcion' => 'Lanzada en 2013, la Xbox One integró entretenimiento y juegos, con capacidades multimedia avanzadas y una sólida biblioteca de juegos.',
                'ruta_imagen' => 'images/xboxone.png',
                'money' => 70700,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo Switch',
                'descripcion' => 'Lanzada en 2017, la Switch combina el juego de consola y portátil en un solo dispositivo, con títulos exitosos como The Legend of Zelda: Breath of the Wild.',
                'ruta_imagen' => 'images/switch.png',
                'money' => 80800,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'PlayStation 5',
                'descripcion' => 'Lanzada en 2020, la PlayStation 5 ofrece gráficos de nueva generación, tiempos de carga ultrarrápidos y una innovadora experiencia de juego.',
                'ruta_imagen' => 'images/play5.png',
                'money' => 90900,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
?>
