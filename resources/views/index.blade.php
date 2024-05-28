<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Merge Games</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="bg-blue-500 min-h-screen flex items-center justify-center">
        <div class="contenedor bg-gray-100 shadow-md rounded sm:p-8 sm:pb-0">
            <h1 class="text-xl sm:text-2xl mb-4 text-center">Merge Games</h1>
            <div class="flex place-content-around">
                <div class="divNivel text-blue-500">
                    {{ $nivel }}
                </div>
                <div class="flex">
                    <img src="{{ asset('images/moneda.png') }}" alt="" class="w-7">
                    <div class="divDinero">
                        {{ $dinero }}
                    </div>
                </div>
                <div class="divDineroQueGenera text-blue-500">
                    
                </div>
            </div>

            <div class="grilla grid 
            @if ($tablero->n_casillas <= 4)
                grid-cols-2
            @elseif ($tablero->n_casillas <= 9)
                grid-cols-3
            @elseif ($tablero->n_casillas <= 12)
                grid-cols-4
            @elseif ($tablero->n_casillas <= 20)
                grid-cols-5
            @elseif ($tablero->n_casillas <= 25)
                grid-cols-6
            @endif">
                @for ($i = 1; $i < $numeroCasillas + 1; $i++)
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
                        <div class="casilla bg-transparent p-2 sm:p-4 text-center w-16 h-16 sm:w-24 sm:h-24">
                            <img src="{{ asset($consola->ruta_imagen) }}" alt="img" class="w-full h-full object-contain">
                        </div>
                    @else
                        <div class="casilla bg-transparent p-2 sm:p-4 text-center w-16 h-16 sm:w-24 sm:h-24"></div>
                    @endif
                @endfor
            </div>
            <div class="botones text-center">
                <div onclick="mostrarLogros()" class="boton mt-4 text-lg sm:text-xl text-center">
                    <p>Logros</p>
                </div>
                <div class="contador mt-4 text-lg sm:text-xl text-center">
                    <p>0</p>
                </div>
                <div class="boton mt-4 text-lg sm:text-xl text-center">
                    <p>Tienda</p>
                </div>
            </div>
        </div>
    </div>

    <div id="divLogros">
        <button onclick="ocultarLogros()" class="p-2 px-4">X</button>
        
    </div>

    <script>
        //Exportar el nivel para poder usarlo en el script
        var nivelUsuario = {{ $nivel }};
        const consolas = @json($consolas);
    </script>

    <script src="js/script.js"></script>
</body>
</html>
