@extends('layout.layout')
@section('content')
    <h3 class="mt-2">Все места</h3>
    <a class="btn btn-primary mt-3 w-25 mb-3" href="{{route('places_create')}}">Добавить место</a>
    <div class="d-flex flex-column align-items-center">
        @foreach($places as $place)
            <a href="/places/{{$place->id}}/" class="text-decoration-none d-flex w-100 flex-row justify-content-between bg-dark text-white p-3 mb-2 mt-2 rounded">
                <div class="">
                    <p class="fw-bold">{{$place->name}}</p>
                    <p class="">{{$place->description}}</p>
                </div>
            </a>
        @endforeach
        <p class="align-self-start">На странице: {{count($places)}}</p>
        {{ $places->links() }}
    </div>
@endsection
