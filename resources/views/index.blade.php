<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Merge Games</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="icon" href="images/moneda.png" type="image/png"/>
</head>
<body class="bg-gray-100">
    <div class="relative">
        <button id="menuButton" class="p-2 text-white rounded-lg focus:outline-none">
            ☰
        </button>
        <div id="dropdownMenu" class="absolute left-0 mt-2 w-48  bg-white border border-gray-300 rounded-lg shadow-lg hidden text-center">
            <p>{{auth()->user() ? auth()->user()->name : 'Invitado'}}</p>
            <hr class="my-2">
            @if (auth()->check())
                <a onclick="mostrarConfirmacion()" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 cursor-pointer">Reiniciar Juego</a>
                @role('administrador')
                    <a href="/admin" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Panel de Aministrador</a>
                @endrole
            @endif
            <form id="logout-form" action="{{ secure_url('/admin/logout') }}" method="POST" class="p-2" onsubmit="return actualizarDatosUsuario(event);"> 
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded flex w-full justify-center items-center">
                    <svg class="fi-btn-icon transition duration-75 h-5 w-5 text-white dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M19 10a.75.75 0 0 0-.75-.75H8.704l1.048-.943a.75.75 0 1 0-1.004-1.114l-2.5 2.25a.75.75 0 0 0 0 1.114l2.5 2.25a.75.75 0 1 0 1.004-1.114l-1.048-.943h9.546A.75.75 0 0 0 19 10Z" clip-rule="evenodd"/>
                    </svg>
                    Sign out
                </button>
            </form>
        </div>
    </div>

    <header class="flex justify-center pt-2" style="background-color: #333; height: 15vh">
        <img src="{{ asset('images/maybe.png') }}" alt="imagen logo" class="logo" onclick="actualizarDatosUsuario()">
    </header>

    <div class="contenedorPrincipal min-h-screen p-3 pt-0">
        <div class="contenedor rounded flex flex-col items-center">
            <div class="datos flex place-content-around" style="width: 100%">
                <div class="divNivel">
                    <img src="{{ asset('images/estrella.png') }}" class="mr-1" style="width: 2vw">
                    {{ $nivel }}
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/moneda.png') }}" alt="" class="mr-1" style="width: 2vw">
                    <div class="divDinero flex ">
                        @if ($dinero > 0) {
                            {{ $dinero }}
                        } @else {
                            0
                        }
                        @endif
                    </div>
                </div>
                <div class="divDineroQueGenera flex items-center justify-center">
                </div>
            </div>

            <div class="grilla">
                @for ($i = 1; $i < $tablero->n_casillas + 1; $i++)
                    @php
                        $consola = $tablero->consolas()
                            ->select('c.ruta_imagen')
                            ->join('tableros_consolas as tc', 'tc.consola_id', '=', 'consolas.id')
                            ->join('consolas as c', 'c.id', '=', 'tc.consola_id')
                            ->where('tc.posicion', $i)
                            ->where('tc.tablero_id', $tablero->id)
                            ->first();
                    @endphp

                    @if ($consola)
                        <div class="casilla bg-transparent text-center">
                            <img src="{{ asset($consola->ruta_imagen) }}" alt="img">
                        </div>
                    @else
                        <div class="casilla bg-transparent text-center"></div>
                    @endif
                @endfor
            </div>
            <div class="botones flex justify-center">
                <img onclick="mostrarLogros()" src="{{ asset('images/medalla.png') }}" alt="imagen de medalla" class="cursor-pointer">
                <div class="contador text-center cursor-pointer">
                    <p>0</p>
                </div>
                <img onclick="mostrarTienda()" src="{{ asset('images/tienda.png') }}" alt="imagen de tienda" class="cursor-pointer">
            </div>
        </div>
    </div>

    <div id="divLogros"></div>

    <div id="divTienda"></div>

    <div id="divInfoConsola"></div>

    <div id="divConfirmacion" class="flex flex-col items-center justify-center h-screen bg-gray-100 p-4">
        <h2 class="text-center font-bold mb-4">
            ¿Está seguro que quiere reiniciar el juego? <br>
            Tu progreso actual se perderá.
        </h2>
        <div class="flex gap-4">
            <button onclick="window.location.href='{{ route('index') }}'" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </button>
            <button onclick="reiniciarJuego()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Confirmar
            </button>
        </div>
    </div>

    @if (@auth()->check())
        <script>
            const invitado = false;
        </script>
    @else 
        <script>
            const invitado = true;
        </script>
    @endif

    <script>
        //Exportar el nivel para poder usarlo en el script
        var nivelUsuario = {{ $nivel }};
        const consolas = @json($consolas);

        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        menuButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!menuButton.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

    </script>

    <script src="js/script.js"></script>
</body>
</html>
