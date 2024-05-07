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
                    <div class="casilla bg-gray-200 p-4 text-center" style="width: 90px; height: 90px; grid-column: {{ $consola->posicion }}">
                        <img src="{{ asset($consola->ruta_imagen) }}" alt="img">
                    </div>
                @endforeach
            
                @for ($i = 0; $i < $numeroCasillas - $tablero->consolas->count(); $i++)
                    <div class="casilla bg-gray-200 p-4 text-center" style="width: 90px; height: 90px;"></div>
                @endfor
            </div>
             
            <div class="contador">
                <p>0</p>
            </div>
        </div>
    </div>


    <script>
        let contador = 0;
        const divContador = document.querySelector('.contador');
        const textoContador = document.querySelector('.contador p');
        const casillas = document.querySelectorAll('.casilla');

        divContador.addEventListener('click', () => {
            if (contador < 10) {
                contador ++;
                textoContador.innerText = contador;
            }
        })

        setInterval(() => {
            if (contador <= 10) {
                textoContador.innerText = contador;
            } else {
                contador = 0;
                textoContador.innerText = '0';

                var casillasLibres = [];
                for (var i = 0; i < casillas.length; i++) {
                    if (casillas[i].querySelector('img') == null) {
                        casillasLibres.push(casillas[i]);
                    }
                }
                
                if (casillasLibres.length > 0) {
                    nuevaConsola();
                } else {
                    contador = 11;
                    textoContador.innerText = 'FULL!';
                }
               
            }
            contador++;
        }, 1000);


        function nuevaConsola() {
            var casillasLibres = [];
            for (var i = 0; i < casillas.length; i++) {
                if (casillas[i].querySelector('img') == null) {
                    casillasLibres.push(casillas[i]);
                }
            }
            if (casillasLibres.length > 0) {
                // Obtener un nombre de consola del primer elemento de la lista de consolas de Laravel
                var imagenConsola = "{{ $tablero->consolas->first()->ruta_imagen }}";

                // Elegir una casilla libre al azar
                var casillaAleatoria = casillasLibres[Math.floor(Math.random() * casillasLibres.length)];

                // Imprimir el nombre de la consola en la casilla elegida al azar
                casillaAleatoria.innerHTML = "<img src='"+imagenConsola+"' alt='img'>";
            } else {
                console.log("No hay casillas libres disponibles.");
            }
            
        }



        
    </script>

</body>

</html>

