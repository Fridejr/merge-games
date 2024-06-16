<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                background-color: #09090b;
            }
            .contenedor {
                display: flex;
                text-align: center;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border: 1px solid #cccccca1;
                border-radius: 15px;
                background-color: #18181b;
                color: white;
                min-height: 60%;
                padding: 3%;
                font-family: 'Times New Roman', Times, serif;
                
                img {
                    width : 40%;
                    user-select: none;
                }
            }

            h1 {
                font-size: 2.5vw;
            }

            .button {
                display: inline-block;
                margin: 10px;
                padding: 10px 20px;
                font-size: 1.4vw;
                font-weight: 600;
                text-align: center;
                color: #fff;
                background-color: #f59e0b;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
                user-select: none;
            }
            .button:hover {
                background-color: #ff8800;
            }

            a {
                text-decoration: none;
            }

        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        @if (auth()->check())
            <script>
                window.location.href = "{{ url('/index') }}";
            </script>
        @else
            <div class="contenedor min-h-screen bg-gray-50 dark:bg-black">
                <div class="bg-white dark:bg-zinc-900 p-8 rounded-lg shadow-lg flex items-center justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                    <h1 class="font-semibold text-black dark:text-white mb-6 text-center">Bienvenido, ¿Qué desea hacer?</h1>
                    <div class="flex flex-col items-center">
                        <a href="{{ route('index') }}" class="button">Entrar como Invitado</a>
                        <a href="{{ route('login') }}" class="button">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="button">Registrarse</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Existing content for authenticated users -->

    </body>
</html>
