@extends('layouts.app')

@section('title-block')Мой профиль@endsection

@section('content')
    <div class="user-builds-container">
        <div class="user-builds">
            <h1>Мои сборки</h1>
            @foreach ($builds as $build)
                <p>{{$build->name}}</p>
                @foreach ($build->components as $component)
                    <p>{{$component->name}}</p>
                @endforeach
            @endforeach
        </div>
    </div>

@endsection