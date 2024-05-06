<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grid 4x4 con Tailwind CSS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-md rounded p-8">
            <h1 class="text-2xl mb-4">Grid 4x4</h1>

            <div class="grid grid-cols-2 gap-4">
                @foreach ($tablero->consolas as $consola)
                    <div class="bg-gray-200 p-4 text-center" style="width: 90px; height: 90px; grid-column: {{ $consola->posicion }}">
                        {{ $consola->nombre }} 
                    </div>
                @endforeach
            
                @for ($i = 0; $i < $numeroCasillas - $tablero->consolas->count(); $i++)
                    <div class="bg-gray-200 p-4 text-center" style="width: 90px; height: 90px;" onclick="escribirNumero(this)"></div>
                @endfor
            </div>
            
            
            
        </div>
    </div>


    <script>
        function escribirNumero(element) {
            element.innerText = "{{ $tablero->consolas->first()->nombre }}";
        }
    </script>

</body>

</html>

