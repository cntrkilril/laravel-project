@extends('layout.layout')
@section('content')
    <h3 class="mt-2">Назначить вещь</h3>
    <form class="d-flex flex-column" action="{{route("uses_store")}}" method="post">
        @csrf
        <div class="w-50">
            <input class="form-control mt-3" type="text" name="name" id="name" value="{{$use->name}}" disabled>
            <input class="d-none" type="text" name="thing_id" id="id" value="{{$use->id}}">
            <label for="amount" class="form-label mt-3 ">Выберите количество</label>
            <select class="form-select " name="amount" aria-label="Default select example">
                @for($i=1; $i<=$free_count; $i++)
                    <option value='{{$i}}'>{{$i}}</option>
                @endfor
            </select>
            <label for="place_id" class="form-label mt-3 ">Выберите место</label>
            <select class="form-select" name="place_id" aria-label="Default select example">
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
            <label for="user_id" class="form-label mt-3 ">Выберите человека</label>
            <select class="form-select" name="user_id" aria-label="Default select example">
                @foreach($users as $user)
                    @if($user->id == auth()->user()->id)
                        <option value='{{$user->id}}'>Я</option>
                    @else
                        <option value='{{$user->id}}'>{{$user->name}}</option>
                    @endif
                @endforeach
            </select>
            <button class="btn btn-primary mt-3 w-50" type="submit">Назначить вещь</button>
        </div>
    </form>
@endsection
