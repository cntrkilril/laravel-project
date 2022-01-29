@extends('layout.layout')
@section('content')
    <h3 class="mt-2">Все пользователи</h3>
    <div class="d-flex flex-column align-items-center">
        @foreach($users as $user)
            @auth("web")
                <a href="/users/{{$user->id}}/" class="text-decoration-none d-flex w-100 flex-row justify-content-between p-3 mb-2 mt-2 rounded
                    @if($user->id==auth()->user()->id)
                    bg-warning text-black
                    @else
                    bg-dark text-white
                    @endif
                    ">
                    <div class="">
                        <p class="fw-bold">{{$user->name}}</p>
                    </div>
                </a>
            @endauth
            @guest("web")
                <a href="/users/{{$user->id}}/" class="text-decoration-none d-flex w-100 flex-row justify-content-between p-3 mb-2 mt-2 rounded bg-dark text-white">
                    <div class="">
                        <p class="fw-bold">{{$user->name}}</p>
                    </div>
                </a>
            @endguest
        @endforeach
        <p class="align-self-start">На странице: {{count($users)}}</p>
        {{ $users->links() }}
    </div>
@endsection
