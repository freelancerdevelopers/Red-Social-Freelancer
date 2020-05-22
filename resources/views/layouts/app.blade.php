<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Red social de imagenes de codigo abierto"/>
    <meta name="keywords" content="Red social freelancer, social media"/>
    <meta name="author" content="Luis Rogelio Batres Guarneros" />
    <meta name="copyright" content="lBatres" />
    <meta name="owner" content="lBatres" />
    <meta name="robots" content="index,follow">
    <link type="text/css" rel="shortcut icon" href="{{ asset('image/Icon_FreelancerDevelopers.png') }}/">
    <link type="images/x-icon" rel="icon" href="{{ asset('image/Icon_FreelancerDevelopers.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Developers | Red Social</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('font/css/font-awesome.css')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" src="{{ asset('image/Freelancerdevelopers.png') }}" alt="social-freelancer" title="social-freelancer"/>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <form id="frmsearch" method="GET" action="{{route('users.list')}}">
                            <div class="input-group">
                                <input id="insearch" type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                  <button class="btn btn-default" type="submit">
                                    <i class="fa  fa-search"></i>
                                  </button>
                                </div>
                            </div>
                        </form>
                            <li class="nav-item dropdown">
                                <a href="{{ route('image.create') }}" class="nav-link">Subir imagen</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @include('includes.avatar') {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('users.list') }}">Lista de usuarios</a>
                                    <a class="dropdown-item" href="{{ route('profile', ['id'=> Auth::user()->id ]) }}">Mi perfil</a>
                                    <a class="dropdown-item" href="{{ route('config') }}">Configuración</a>
                                    <a class="dropdown-item" href="#">Politicas y Condiciones</a>
                                    <hr/>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer>
        Red social Online Demo | <a target="blank" href="https://www.freelancerdevelopers.com/">FreelancerDevelopers.com </a>
    </footer>
        
</body>
</html>
