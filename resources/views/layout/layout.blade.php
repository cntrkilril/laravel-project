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
    @can('admin-panel')
        <div class="navbar navbar-expand-lg navbar-light bg-dark text-white">
            <div class="d-flex flex-column container-fluid">
                <h1 class="text-center w-100">Административная панель</h1>
                <p class="">У обычных пользователей ее нет</p>
            </div>
        </div>
    @endcan
    <header class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">EXAM</a>
                <div class="navbar-nav d-flex justify-content-start w-100">
                    <a class="nav-link @if($path[0] == "")active @endif" href="{{route("about")}}">О проекте</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if($path[0] == "things")active @endif" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Вещи
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route("home")}}">Все вещи</a></li>
                            <li><a class="dropdown-item" href="{{route('things_repair')}}">Вещи в специальных местах</a></li>
                            <li><a class="dropdown-item" href="{{route('things_work')}}">Вещи в работе</a></li>
                            <li><a class="dropdown-item" href="{{route('things_used')}}">Использующиеся вещи</a></li>
                            @auth("web")
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route('things_my')}}">Мои вещи</a></li>
                            @endauth
                        </ul>
                    </div>
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
                        <a class="nav-link @if(count($path) != 1)
                        @if($path[0] == "things" && $path[1] == "taken") active @endif
                        @endif" href="{{route('things_taken')}}">Взятые_вещи</a>
                        <a class="nav-link" href="{{route("logout")}}">Выйти</a>
                    @endauth
                    @guest("web")
                        <a class="nav-link @if($path[0] == "login" || $path[0] == "register")active @endif" href="{{route("login")}}">Войти</a>
                    @endguest
                </div>
            </div>
        </nav>
    </header>
        <div class="mb-5 px-5 w-100">
            @yield('content')
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
