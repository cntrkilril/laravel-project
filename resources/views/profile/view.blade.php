@extends('layout.layout')
@section('content')
    @if($user->id == auth()->user()->id)
        <h3 class="mt-2">Мой профиль</h3>
    @else
        <h3 class="mt-2">Профиль другого пользователя</h3>
    @endif
    <h4 class="mt-2 mb-2">{{$user->name}}</h4>
    <p class="">{{$user->email}}</p>
    <h4 class="mt-2 mb-2">Личные вещи</h4>
    <p class=""><b>Использующиеся сейчас:</b> {{$free_things}}</p>
    <p class=""><b>Всего: </b>{{count($things)}}</p>
    @if($user->id == auth()->user()->id)
        <h4 class="mt-2">Мои вещи</h4>
    @else
        <h4 class="mt-2">Вещи пользователя</h4>
    @endif
    <div class="d-flex flex-column align-items-center">
        @foreach($things as $thing)
            <a href="/things/{{$thing->id}}/" class="text-decoration-none d-flex w-100 flex-row justify-content-between bg-dark text-white p-3 mb-2 mt-2 rounded">
                <div class="">
                    <p class="fw-bold">{{$thing->name}}</p>
                    <p class="">{{$thing->description}}</p>
                </div>
                @if(auth()->user()->id == $thing->master_id)
                    <div class="bg-warning rounded p-2 align-items-center d-flex ms-3">
                        <p class="p-0 m-0 align-self-center">моё</p>
                    </div>
                @endif
            </a>
        @endforeach
    </div>
@endsection
