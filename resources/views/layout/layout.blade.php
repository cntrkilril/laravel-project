<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
    <body class="antialiased">
    <header class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route("about")}}">EXAM</a>
                @auth("web")
                    <div class="navbar-nav d-flex justify-content-start w-100">
                        <a class="nav-link" href="{{route("home")}}">Вещи</a>
                        <a class="nav-link" href="{{route("logout")}}">Места</a>
                    </div>
                @endauth
                <div class="navbar-nav d-flex justify-content-end">
                    @auth("web")
                        <a class="nav-link" href="{{route("logout")}}">Профиль</a>
                        <a class="nav-link" href="{{route("logout")}}">Выйти</a>
                    @endauth
                    @guest("web")
                        <a class="nav-link" href="{{route("login")}}">Войти</a>
                    @endguest
                </div>
            </div>
        </nav>
    </header>
        <div class="container mb-5">
            @yield('content')
        </div>
    </body>
</html>
