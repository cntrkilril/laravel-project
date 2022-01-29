@extends('layout.layout')
@section('content')
    <a class="nav-link mt-2" href="{{route("home")}}">Вернуться к новостям</a>
    <h3 class="mt-2 mb-2">{{$thing->name}}</h3>
    @if($thing->master_id==auth()->user()->id)
        <div class="rounded align-items-center d-flex p-0">
            <a href="/things/{{$thing->id}}/edit" class="btn btn-success">Редактировать</a>
            <form class="" action="/things/{{$thing->id}}/delete" method="post">
                @csrf
                <button class="btn btn-danger ms-3" type="submit">Удалить</button>
            </form>
        </div>
    @endif
    <p class="mt-4"><b>Гарантия/Срок годности: </b>{{$thing->wrnt}}</p>
    <p class="mt-2 fw-bold">Описание товара</p>
    <p class="mt-2">{{$thing->description}}</p>
@endsection
