@extends('layout.layout')
@section('content')
    <a class="nav-link mt-2" href="{{route("home")}}">Вернуться к новостям</a>
    <h3 class="mt-2 mb-2">{{$thing->name}}</h3>
            <div class="d-flex justify-content-between">
{{--                @can('delete-update', $thing)--}}
                @canany(['delete', 'update'], $thing)
                    <div class="align-items-center d-flex p-0">
                        <a href="/things/{{$thing->id}}/edit" class="btn btn-success">Редактировать</a>
                        <form class="" action="/things/{{$thing->id}}/delete" method="post">
                            @csrf
                            <button class="btn btn-danger ms-3" type="submit">Удалить</button>
                        </form>
                    </div>
                @endcanany
{{--                @endcan()--}}
                    <div class="align-items-center d-flex p-0 justify-items-center">
                        @if($free_count != 0)
                            <a href="/uses/{{$thing->id}}/create" class="btn btn-success">Начать использовать</a>
                        @endif
                        <?php
                            $use_check = \App\Models\UseModel::where('user_id',auth()->user()->id)->where('thing_id', $thing->id)->get();
                            ?>
                        @if( count($use_check) != 0)
                            <form class="" action="/uses/{{$thing->id}}/{{$use_check[0]->place_id}}/{{auth()->user()->id}}/delete" method="post">
                                @csrf
                                <button class="btn btn-danger ms-3" type="submit">Перестать пользоваться</button>
                            </form>
                        @endif
                    </div>
            </div>
    @if($free_count == 0)
        <p class="mt-4 text-danger"><b>Доступное количество: </b>{{$free_count}}</p>
    @else
        <p class="mt-4"><b>Доступное количество: </b>{{$free_count}}</p>
    @endif
    <p class="mt-2"><b>Гарантия/Срок годности: </b>{{$thing->wrnt}}</p>
    <p class="mt-2 fw-bold">Описание вещи</p>
    <p class="mt-2">{{$thing->description}}</p>
    <p class="mt-2 fw-bold">Использование вещи</p>
    @if($uses[0] -> amount != null)
        <div class="d-flex flex-column align-items-center">
            @foreach($uses as $use)
                <div class="text-decoration-none d-flex w-100 flex-row justify-content-between bg-dark text-white p-3 mb-2 mt-2 rounded">
                    <div class="">
                        <p class="fw-bold">{{\App\Models\User::findOrFail($use->user_id)->name}}</p>
                        <p class="">Место: {{\App\Models\Place::findOrFail($use->place_id)->name}}</p>
                        <p class="">Кол-во: {{$use->amount}}</p>
                    </div>
                </div>
            @endforeach
    </div>
    @else
        <p class="mt-2">Вещь в данный момент не используется</p>
    @endif
@endsection
