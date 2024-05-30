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
                'descripcion' => 'Lanzada en 1983, la NES es una consola de videojuegos de 8 bits desarrollada por Nintendo. Fue un gran éxito comercial y ayudó a revitalizar la industria de los videojuegos después del colapso de 1983.',
                'ruta_imagen' => 'images/nes.png',
                'money' => 1.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Atari 7800',
                'descripcion' => 'Lanzada en 1986, la Atari 7800 es una consola de videojuegos de 8 bits desarrollada por Atari. Fue diseñada para competir con la NES, pero no tuvo el mismo éxito comercial.',
                'ruta_imagen' => 'images/atari.png',
                'money' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo Game Boy',
                'descripcion' => 'Lanzada en 1989, la Game Boy es una consola de videojuegos portátil de 8 bits desarrollada por Nintendo. Fue la primera consola portátil en usar cartuchos de juegos intercambiables.',
                'ruta_imagen' => 'images/gameboy.png',
                'money' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation',
                'descripcion' => 'Lanzada en 1994, la PlayStation es una consola de videojuegos de 32 bits desarrollada por Sony. Revolucionó la industria de los videojuegos con sus gráficos en 3D y su capacidad de CD-ROM.',
                'ruta_imagen' => 'images/play1.png',
                'money' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo 64',
                'descripcion' => 'Lanzada en 1996, la Nintendo 64 es una consola de videojuegos de 64 bits desarrollada por Nintendo. Fue la última consola de sobremesa en usar cartuchos como medio principal de almacenamiento.',
                'ruta_imagen' => 'images/nintendo64.png',
                'money' => 64,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation 2',
                'descripcion' => 'Lanzada en 2000, la PlayStation 2 es una consola de videojuegos de 128 bits desarrollada por Sony. Es la consola más vendida de todos los tiempos, con más de 155 millones de unidades vendidas.',
                'ruta_imagen' => 'images/play2.png',
                'money' => 130,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo GameCube',
                'descripcion' => 'Lanzada en 2001, la GameCube es una consola de videojuegos de 128 bits desarrollada por Nintendo. Fue la primera consola de Nintendo en usar discos ópticos como medio de almacenamiento.',
                'ruta_imagen' => 'images/gamecube.png',
                'money' => 270,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Microsoft Xbox',
                'descripcion' => 'Lanzada en 2001, la Xbox es una consola de videojuegos de 128 bits desarrollada por Microsoft. Fue la primera consola en incorporar un disco duro interno y soporte para banda ancha.',
                'ruta_imagen' => 'images/xbox.png',
                'money' => 550,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo Game Boy Advance',
                'descripcion' => 'Lanzada en 2001, la Game Boy Advance es una consola de videojuegos portátil de 32 bits desarrollada por Nintendo. Es conocida por su amplio catálogo de juegos y su diseño compacto.',
                'ruta_imagen' => 'images/gameboyadvance.png',
                'money' => 1160,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation Portable (PSP)',
                'descripcion' => 'Lanzada en 2004, la PSP es una consola de videojuegos portátil de 32 bits desarrollada por Sony. Fue la primera consola portátil en ofrecer gráficos de alta calidad y reproducción de medios.',
                'ruta_imagen' => 'images/psp.png',
                'money' => 2400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo DS',
                'descripcion' => 'Lanzada en 2004, la DS es una consola de videojuegos portátil de 32 bits desarrollada por Nintendo. Es conocida por su doble pantalla, una de las cuales es táctil.',
                'ruta_imagen' => 'images/ds.png',
                'money' => 4900,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Xbox 360',
                'descripcion' => 'Lanzada en 2005, la Xbox 360 es una consola de videojuegos de séptima generación desarrollada por Microsoft. Introdujo Xbox Live, una plataforma de juegos en línea y distribución de contenido digital.',
                'ruta_imagen' => 'images/xbox360.png',
                'money' => 9950,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation 3',
                'descripcion' => 'Lanzada en 2006, la PlayStation 3 es una consola de videojuegos de séptima generación desarrollada por Sony. Introdujo el Blu-ray como formato principal de almacenamiento.',
                'ruta_imagen' => 'images/play3.png',
                'money' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo Wii',
                'descripcion' => 'Lanzada en 2006, la Wii es una consola de videojuegos de séptima generación desarrollada por Nintendo. Es conocida por su innovador control de movimiento y su amplia aceptación entre jugadores casuales.',
                'ruta_imagen' => 'images/wii.png',
                'money' => 30300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo 3DS',
                'descripcion' => 'Lanzada en 2011, la 3DS es una consola de videojuegos portátil de 32 bits desarrollada por Nintendo. Es conocida por su capacidad de mostrar gráficos en 3D sin necesidad de gafas especiales.',
                'ruta_imagen' => 'images/3ds.png',
                'money' => 40400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sony PlayStation Vita',
                'descripcion' => 'Lanzada en 2011, la PlayStation Vita es una consola de videojuegos portátil de 32 bits desarrollada por Sony. Ofrece gráficos de alta calidad y conectividad con la PlayStation 4.',
                'ruta_imagen' => 'images/psvita.png',
                'money' => 50500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'PlayStation 4',
                'descripcion' => 'Lanzada en 2013, la PlayStation 4 es una consola de videojuegos de octava generación desarrollada por Sony. Es conocida por sus potentes capacidades gráficas y su integración con servicios multimedia.',
                'ruta_imagen' => 'images/play4.png',
                'money' => 60600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Xbox One',
                'descripcion' => 'Lanzada en 2013, la Xbox One es una consola de videojuegos de octava generación desarrollada por Microsoft. Ofrece una amplia gama de servicios de entretenimiento y una potente integración con Windows 10.',
                'ruta_imagen' => 'images/xboxone.png',
                'money' => 70700,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nintendo Switch',
                'descripcion' => 'Lanzada en 2017, la Switch es una consola de videojuegos híbrida desarrollada por Nintendo. Puede usarse tanto como consola de sobremesa como portátil, ofreciendo una versatilidad única.',
                'ruta_imagen' => 'images/switch.png',
                'money' => 80800,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'PlayStation 5',
                'descripcion' => 'Lanzada en 2020, la PlayStation 5 es una consola de videojuegos de novena generación desarrollada por Sony. Ofrece gráficos de alta resolución, tiempos de carga rápidos y una experiencia de juego inmersiva.',
                'ruta_imagen' => 'images/play5.png',
                'money' => 90900,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
