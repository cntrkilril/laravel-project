<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="icon" href="{{ asset('icon.ico') }}">
    </head>
    <body class="antialiased">
    <?php
        $path = explode('/', request()->path());
    ?>
    <header class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">EXAM</a>
                <div class="navbar-nav d-flex justify-content-start w-100">
                    <a class="nav-link @if($path[0] == "")active @endif" href="{{route("about")}}">О проекте</a>
                    <a class="nav-link @if($path[0] == "things")active @endif" href="{{route("home")}}">Вещи</a>
                    <a class="nav-link @if($path[0] == "places")active @endif" href="{{route("places")}}">Места</a>
                    <a class="nav-link @if($path[0] == "users" && count($path) == 1) active
                        @elseif($path[0] == "users" && $path[1] != auth()->user()->id) active
                        @endif" href="{{route("profiles")}}">Пользователи</a>
                </div>
                <div class="navbar-nav d-flex justify-content-end">
                    @auth("web")
                        <a class="nav-link @if(count($path) != 1)
                            @if($path[0] == "users" && $path[1] == auth()->user()->id) active @endif
                        @endif" href="/users/{{auth()->user()->id}}">Профиль</a>
                        <a class="nav-link" href="{{route("logout")}}">Выйти</a>
                    @endauth
                    @guest("web")
                        <a class="nav-link @if($path[0] == "login" || $path[0] == "register")active @endif" href="{{route("login")}}">Войти</a>
                    @endguest
                </div>
            </div>
        </nav>
    </header>
        <div class="mb-5 mx-5">
            @yield('content')
        </div>
    </body>
</html>
