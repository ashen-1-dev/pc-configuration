@extends('layouts.app')
@section('title-block')Список компонентов@endsection
@section('content')
    <div class="container">
        <a href="{{URL::route('components.create')}}">Добавить</a>
        <h1>Компоненты</h1>
            <ul class="component-list">
                @foreach($components as $component)
                <li>
                    <a href="{{URL::route('components.show', $component->id, false)}}">
                        {{$component->name}} ({{$component->type->name}}) &mdash;
                        <form class="delete-button" action="{{URL::route('components.destroy', $component->id, false)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">Удалить</button>
                        </form>
                        <form
                                style="display: inline"
                                action="{{URL::route('components.edit', $component->id, false)}}"
                                method="get">
                            <button type="submit">Изменить</button>
                        </form>
                    </a>
                </li>
                @endforeach
            </ul>
    </div>
@endsection
