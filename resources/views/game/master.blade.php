<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Світ музики</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css" rel="stylesheet" type="text/css">
    <script src="/js/fontawesome.min.js"></script>
    <script src="/js/fa-brands.min.js"></script>
    <script src="/js/fa-regular.min.js"></script>
    <style>
        html, body {
            background: #f5f8fa;
            height: 100%;
        }
        #h-v-center {
            align-items: center;
            display: flex;
            justify-content: center;
            height: 100%;
        }
        button {
            display: block;
            margin-top: 1em;
            width: 100%;
        }
    </style>
</head>
<body>
<form action="/logout" id="logoutform" method="post">
    {!! csrf_field() !!}
</form>
<div id="h-v-center">
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="box">
                    <nav class="navbar">
                        <div class="navbar-brand">
                            <a class="navbar-item is-size-3" href="{{ route('game') }}">Світ музики</a>
                        </div>
                        <div class="navbar-menu">
                            <div class="navbar-end">
                                <a class="navbar-item" href="{{route('game.leaderboard')}}">Список переможців</a>
                                @if (Auth::check())
                                    <span class="navbar-item"><a class="button is-info" href="{{route('game.playlist')}}">Плейліст</a></span>
                                    <div class="navbar-item">{{ Auth::user()->name }}</div>
                                    <div class="navbar-item"><a href="{{route('home')}}">Home</a></div>
                                    <div class="navbar-item">
                                        <input class="button is-danger" form="logoutform" type="submit" value="Log Out">
                                    </div>
                                @else
                                    <span class="navbar-item"><a class="button is-info" href="/register">Реєстрація</a></span>
                                    <span class="navbar-item"><a class="button is-primary" href="/login">Логін</a></span>
                                @endif
                            </div>
                        </div>
                    </nav>
                    <hr />

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

@yield('script')
</body>
</html>
