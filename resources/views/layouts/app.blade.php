<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">

</head>
<body>

    <div id="app">
        <header class="site-header " style="background: #242424; color: white" >
            <div class="container site-header__wrapper">
                <div class="site-header__start">
                    <a href="{{url('/')}}" class="navbar-brand brand" style="text-decoration: none;
    color: white;">Світ музики</a>
                </div>
                <div class="site-header__middle">
                    <nav class="nav">
                        <button class="nav__toggle" aria-expanded="false" type="button">
                            menu
                        </button>
                        <ul style="list-style: none; margin-top: revert" class="nav__wrapper">
                            <li class="nav__item"><a style="text-decoration: none; color: white;" href="{{route('game')}}"
                                >Гра "Вгадай мелодію"</a>
                            </li>
                            @if(Auth::user() && Auth::user()->email == 'antonslogerg@gmail.com')
                                <li class="nav__item"><a style="text-decoration: none;color: white;" href="{{route('artist.index')}}"
                                    >Admin Panel</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                @guest
                    <div class="site-header__end">
                        <a href="{{ route('login') }}" style="text-decoration: none;color: white; font-size: 15px">Увійти</a>
                    </div>
                @else
                    <div class="site-header__end">
                        <li style="list-style: none;" class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="text-decoration: none;color: white; font-size: 15px">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </div>
                @endguest
            </div>
        </header>
{{--        <nav style="background:rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;" class="navbar navbar-expand-md navbar-dark bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand"  href="{{ url('/') }}">--}}
{{--                    Світ Музики--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav me-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ms-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ route('game') }}">Game "Guess the song"</a>--}}
{{--                        </li>--}}
{{--                        @if(Auth::user() && Auth::user()->email == 'antonslogerg@gmail.com')--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ route('event.index') }}">Admin Panel</a>--}}
{{--                        </li>--}}
{{--                        @endif--}}
{{--                        @guest--}}
{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

{{--        <main class="py-4">--}}
            @yield('content')
{{--        </main>--}}
    </div>
</body>
</html>
