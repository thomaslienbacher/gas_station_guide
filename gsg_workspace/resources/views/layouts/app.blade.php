<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/gsg.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Tankstellen Guide
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Sites -->
                        <li class="nav-item @php if(Route::currentRouteName() == 'home') echo 'active' @endphp">
                            <a class="nav-link" href="/">Home

                            </a>
                        </li>
                        <li class="nav-item @php if(Route::currentRouteName() == 'search') echo 'active' @endphp">
                            <a class="nav-link" href="/search">Suchen
                            </a>
                        </li>

                        <!-- vertical line -->
                        <li class="nav-item">
                            <div style="
                                border-left: 1px solid lightgrey;
                                border-radius: 1px 1px 1px 1px;
                                height: 100%;">
                            </div>
                        </li>

                        <!-- horizontal line -->
                        <li class="nav-item">
                            <hr style="
                                color: lightgrey;
                                height: 1px;">
                            </hr>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link @php if(Route::currentRouteName() == 'login') echo 'active' @endphp" href="{{ route('login') }}">Anmelden</a></li>
                            <li><a class="nav-link @php if(Route::currentRouteName() == 'register') echo 'active' @endphp" href="{{ route('register') }}">Registrieren</a></li>
                        @else
                            <li class="nav-item dropdown @php if(strpos(Route::currentRouteName(), "auth") !== false) echo 'active' @endphp">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Abmelden
                                    </a>

                                    <a class="dropdown-item" href="{{ route('auth.mystations') }}">
                                        MyStations
                                    </a>

                                    <a class="dropdown-item" href="{{ route('auth.settings') }}">
										Einstellungen
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
</body>
</html>
