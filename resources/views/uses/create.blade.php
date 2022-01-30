@extends('layout.layout')
@section('content')
    <h3 class="mt-2">Начать использовать вещь</h3>
    <form class="d-flex flex-column" action="{{route("uses_store")}}" method="post">
        @csrf
        <div class="w-50">
            <input class="form-control mt-3" type="text" name="name" id="name" value="{{$use->name}}" disabled>
            <input class="d-none" type="text" name="thing_id" id="id" value="{{$use->id}}">
            <select class="form-select mt-3" name="amount" aria-label="Default select example">
                @for($i=1; $i<=$free_count; $i++)
                    <option value='{{$i}}'>{{$i}}</option>
                @endfor
            </select>
            <select class="form-select mt-3" name="place_id" aria-label="Default select example">
                @foreach($places as $place)
                    <option value='{{$place->id}}'>{{$place->name}} -
                    @if($place->repair == 1)
                        Ремонт/Мойка
                    @else
                        В работе
                    @endif
                    </option>
                @endforeach
            </select>
            <button class="btn btn-primary mt-3 w-50" type="submit">Начать использовать вещь</button>
        </div>
    </form>
@endsection
