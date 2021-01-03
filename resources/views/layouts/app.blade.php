<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tangaroa') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Asap:wght@500&family=Open+Sans:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Roboto+Condensed:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <!-- Icons -->
    {{-- <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css"> --}}
    <script src="https://kit.fontawesome.com/1cc693f93f.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->

</head>

<body id="body">
    <div id="app">
        <nav id="navbar" class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/img/page/tangaroa logo.png" alt="Tangaroa Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarme') }}</a>
                        </li>
                        @endif
                        @else

                        @if (!Auth::user()->isAdmin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('sale') }}">{{ __('Ofertas') }}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('home') }}">{{ __('Administrador') }}</a>
                        </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>



        <main class="">
            
            <div id="app">

                @auth

                @if (strpos( substr(Request::url(), 7) , '/'))

                @if (Auth::user()->isAdmin)

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
                    <div class="container">
                        <a class="navbar-brand" href="/admin/settings">Administrador</a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarText">

                            <ul class="navbar-nav mr-auto">
                                <li
                                    class="nav-item dropdown {{ !(strpos( Request::url() , 'edit-entrenador') || strpos( Request::url() , 'show-entrenador') || strpos( Request::url() , 'create-entrenador') || strpos( Request::url() , 'edit-entrenador')) ? 'active' : ''}}">

                                    <a class=" nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Paquetes
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{url('/admin/settings/create-pack')}}">Crear
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/admin/settings">Lista</a>

                                    </div>

                                </li>

                                <li
                                    class="nav-item dropdown {{ strpos( Request::url() , 'edit-entrenador') || strpos( Request::url() , 'show-entrenador') || strpos( Request::url() , 'create-entrenador') || strpos( Request::url() , 'edit-entrenador') ? 'active' : ''}}">

                                    <a class=" nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Entrenadores
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item"
                                            href="{{url('/admin/settings/create-entrenador')}}">Agregar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/admin/settings/show-entrenador">Lista</a>

                                    </div>

                                </li>

                            </ul>

                        </div>

                    </div>

                </nav>

                @endif

                @endif

                @endauth


                @yield('content')

            </div>
        </main>

        <!--<div class="pre-footer"></div>-->

        <footer id="footer">
            <img src="/img/page/tangaroa logo.png" alt="Tangaroa Logo">
            <p>Copyright © 2020 Tangaroa Entrenamiento</p>
        </footer>
    </div>
</body>

</html>
