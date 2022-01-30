@extends('layout.layout')
@section('content')
    <h3 class="mt-2">Все вещи</h3>
    <a class="btn btn-primary mt-3 w-25 mb-3" href="{{route('things_create')}}">Добавить вещь</a>
    <div class="d-flex flex-column align-items-center">
        @foreach($things as $thing)
            <?php
                    if (\App\Models\UseModel::where('thing_id', $thing->id)->exists()) {
                        $repair = DB::table('use_models')
                        ->join('places', 'use_models.place_id','=','places.id')
                        ->join('things', 'use_models.thing_id', '=', 'things.id')
                        ->where('things.id', '=', $thing->id)
                        ->select('places.repair')
                        ->get()[0]->repair;
                    }
                    else {
                        $repair = '2';
                    }
            ?>
            <a href="/things/{{$thing->id}}/" class="text-decoration-none d-flex w-100 flex-row justify-content-between text-white p-3 mb-2 mt-2 rounded
                @if($repair == '1') bg-info
                @elseif($repair == '0') bg-secondary
                @else bg-dark
                @endif">
                <div class="">
                    <p class="fw-bold">{{$thing->name}}</p>
                    <p class="">{{$thing->description}}</p>
                </div>
                @auth("web")
                    @if($thing->master_id==auth()->user()->id)
                        <div class="bg-warning rounded p-2 align-items-center d-flex ms-3 w-25 ">
                            <p class="p-0 m-0 align-self-center text-center w-100">моё</p>
                        </div>
                    @endif
                    @if($repair == '1')
                        <div class="bg-primary rounded p-2 align-items-center d-flex ms-3 w-25">
                            <p class="p-0 m-0 align-self-center text-center w-100">В ремонте/мойке</p>
                        </div>
                    @elseif($repair == '0')
                        <div class="bg-dark rounded p-2 align-items-center d-flex ms-3 w-25">
                            <p class="p-0 m-0 align-self-center text-center w-100">В работе</p>
                        </div>
                    @endif
                @endauth
            </a>
        @endforeach
        <p class="align-self-start">На странице: {{count($things)}}</p>
            {{ $things->links() }}
    </div>
@endsection
