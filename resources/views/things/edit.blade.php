@extends('layout.layout')
@section('content')
    <h3 class="mt-2">Редактировать вещь</h3>
    <form class="d-flex flex-column" action="{{route("things_store")}}" method="post">
        @csrf
        <div class="w-50">
            <input class="form-control mt-3" type="text" name="name" id="name" placeholder="Введите название" value="{{$thing->name}}">
            <input class="d-none" type="text" name="id" id="id" value="{{$thing->id}}">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <input class="form-control mt-3" type="text" name="description" id="description" placeholder="Введите описание" value="{{$thing->description}}">
            @error('description')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <input class="form-control mt-3" type="date" name="wrnt" id="wrnt">
            <p class="">Установлено: {{$thing->wrnt}}</p>
            @error('wrnt')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <button class="btn btn-success mt-3 w-50" type="submit">Редактировать вещь</button>
        </div>
    </form>
@endsection
