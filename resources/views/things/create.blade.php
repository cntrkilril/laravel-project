@extends('layout.layout')
@section('content')
    <h3 class="mt-2">Добавить вещь</h3>
    <form class="d-flex flex-column" action="{{route("things_store")}}" method="post">
        @csrf
        <div class="w-50">
            <input class="form-control mt-3" type="text" name="name" id="name" placeholder="Введите название">
            <input class="d-none" type="text" name="id" id="id" value="null">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <input class="form-control mt-3" type="text" name="description" id="description" placeholder="Введите описание">
            @error('description')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <input class="form-control mt-3" type="date" name="wrnt" id="wrnt">
            @error('wrnt')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <button class="btn btn-primary mt-3 w-50" type="submit">Добавить вещь</button>
        </div>
    </form>
@endsection
