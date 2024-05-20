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
    <div class="min-h-screen flex items-center justify-center">
        <div class="contenedor shadow-md rounded sm:p-8">
            <h1 class="text-xl sm:text-2xl mb-4 text-center">Merge Games</h1>
            <div class="grilla grid grid-cols-2 sm:grid-cols-4 sm:gap-4">
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
                        <div class="casilla bg-gray-200 p-2 sm:p-4 text-center w-16 h-16 sm:w-24 sm:h-24">
                            <img src="{{ asset($consola->ruta_imagen) }}" alt="img" class="w-full h-full object-contain">
                        </div>
                    @else
                        <div class="casilla bg-gray-200 p-2 sm:p-4 text-center w-16 h-16 sm:w-24 sm:h-24"></div>
                    @endif
                @endfor
            </div>
            <div class="contador mt-4 text-lg sm:text-xl text-center">
                <p>0</p>
            </div>
            <button class="mt-4 px-2 py-1 sm:px-4 sm:py-2 bg-blue-500 text-white rounded" onclick="pruebas()">Pulsar</button>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
