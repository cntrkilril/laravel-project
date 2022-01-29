@extends('layout.layout')
@section('content')
    <h3 class="mt-2">Добавить место</h3>
    <form class="d-flex flex-column" action="{{route("places_store")}}" method="post">
        @csrf
        <div class="w-50">
            <input class="d-none" type="text" name="id" id="id" value="null">
            <input class="form-control mt-3" type="text" name="name" id="name" placeholder="Введите название">
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <input class="form-control mt-3" type="text" name="description" id="description" placeholder="Введите описание">
            @error('description')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="">
                <p class="fw-bold mt-3">Статус</p>
                <div class="form-check mt-0">
                    <input class="form-check-input" type="radio" name="status" id="repair" value="repair">
                    <label class="form-check-label" for="repair">
                        Ремонт/мойка
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="work" value='work' checked>
                    <label class="form-check-label" for="work">
                        Работает
                    </label>
                </div>
            </div>
            @error('status')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <button class="btn btn-primary mt-3 w-50" type="submit">Добавить место</button>
        </div>
    </form>
@endsection
