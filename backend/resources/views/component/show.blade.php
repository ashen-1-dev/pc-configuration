@extends('layouts.app')

@section('title-block')тест@endsection

@section('content')
    <div class="container">
        <h1>{{$component->name}} &mdash; {{$component->type->name}}</h1>
        <ul class="attributes">
            @foreach($component->attributes as $attribute)
                <li>
                    <div class="attribute-container">
                        {{$attribute->name}} &mdash; {{$attribute->pivot->value}}
                    </div>

                </li>

            @endforeach
        </ul>
    </div>
@endsection
