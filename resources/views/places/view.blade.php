@extends('layout.layout')
@section('content')
    <a class="nav-link mt-2" href="{{route("places")}}">Вернуться к местам</a>
    <h3 class="mt-2 mb-2">{{$place->name}}</h3>
    @canany(['update', 'delete'], $place)
        <div class="rounded align-items-center d-flex p-0">
            <a href="/places/{{$place->id}}/edit" class="btn btn-success">Редактировать</a>
            <form class="" action="/places/{{$place->id}}/delete" method="post">
                @csrf
                <button class="btn btn-danger ms-3" type="submit">Удалить</button>
            </form>
        </div>
    @endcanany
    <p class="mt-4"><b>Статус: </b>
        @if($place->repair == 1)
            Ремонт/мойка
        @else
            В работе
        @endif
    </p>
    <p class="mt-2 fw-bold">Описание места</p>
    <p class="mt-2">{{$place->description}}</p>
@endsection
