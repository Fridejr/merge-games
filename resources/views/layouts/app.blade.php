<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Merge Games</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="icon" href="images/moneda.png" type="image/png"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        .navbar {
            background-color: #333 !important;
        }
        .navbar-brand, .nav-link, .dropdown-item {
            color: #FF851B !important;
        }
        .navbar-toggler {
            border-color: #FF851B !important;
            background-color: #FF851B !important;
        }
        navbar-toggler-icon {
            border-color: #e07b1a
        }

        .dropdown-menu {
            background-color: #444 !important;
        }
        .dropdown-item:hover {
            background-color: #555 !important;
        }
        body {
            background-color: #222;
            color: white;
        }
        .card {
            background-color: #333;
            border-color: #FF851B;
        }
        .card-header {
            background-color: #FF851B;
            color: #333;
        }
        .btn-primary {
            background-color: #FF851B;
            border-color: #FF851B;
            color: #333;
        }
        .btn-primary:hover {
            background-color: #e07b1a;
            border-color: #e07b1a;
            color: #333;
        }
        .form-control {
            background-color: #444;
            border-color: #FF851B;
            color: white;
        }
        .form-check-input {
            background-color: #444;
            border-color: #FF851B;
            color: white;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Merge Games
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i><span class="navbar-toggler-icon"></span></i>
                      
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
