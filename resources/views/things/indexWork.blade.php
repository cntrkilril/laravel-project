@extends('layout.layout')
@section('content')
    <h3 class="mt-2">Вещи в работе</h3>
    <a class="btn btn-primary mt-3 w-25 mb-3" href="{{route('things_create')}}">Добавить вещь</a>
    @if(count($things) != 0)
        <div class="d-flex flex-column align-items-center">
            @foreach($things as $thing)
                <a href="/things/{{$thing->id}}/" class="text-decoration-none d-flex w-100 flex-row justify-content-between bg-dark text-white p-3 mb-2 mt-2 rounded">
                    <div class="">
                        <p class="fw-bold">{{$thing->name}}</p>
                        <p class="">{{$thing->description}}</p>
                    </div>
                    @auth("web")
                        @if($thing->master_id==auth()->user()->id)
                            <div class="bg-warning rounded p-2 align-items-center d-flex ms-3">
                                <p class="p-0 m-0 align-self-center">моё</p>
                            </div>
                        @endif
                    @endauth
                </a>
            @endforeach
        </div>
    @else
        <p class="">На данный момент вещей нет</p>
    @endif
@endsection
