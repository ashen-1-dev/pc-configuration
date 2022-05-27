@extends('layouts.app')

@section('title-block')Мой профиль@endsection

@section('content')
    <div class="container">
        <h1>Мои сборки</h1>
        @foreach ($builds as $build)
            <p>{{$build->name}}</p>
            @foreach ($build->components as $component)
                <p>{{$component->name}}</p>
            @endforeach
        @endforeach
    </div>

@endsection