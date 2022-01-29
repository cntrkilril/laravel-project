@extends('layout.layout')
@section('content')

    <form class="d-flex flex-column align-items-center" action="{{route("login_process")}}" method="post">
        @csrf
        <h3 class="mt-3">Авторизация</h3>
        <div class="w-50">
            <input class="form-control mt-3" type="email" name="email" id="email" placeholder="Введите e-mail">
            @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input class="form-control mt-3" type="password" name="password" id="password" placeholder="Введите пароль">
            @error('password')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <button class="btn btn-primary mt-3 w-50" type="submit">Войти</button>
        </div>
    </form>
    <div class="container-fluid mt-5 w-50">
        <a href="{{route("register")}}"  class="btn btn-danger w-100">Зарегистрироваться</a>
    </div>
@endsection
