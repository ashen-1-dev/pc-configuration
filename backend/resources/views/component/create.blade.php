@extends("layouts.app")

@section('title-block')Добавить новый компонент@endsection

@section('content')
    <div class="container">
        <h1>Добавить новый компонент</h1>
        <form action="{{URL::route('components.store', [], false)}}" method="post">
            @csrf
            <h2>Название компонента</h2>
            <input name="name" id="name">
            <h2>Тип компонента</h2>
            <select style="width: 392px; height: 44px" name="type_id" id="type_id">
                @foreach($component_types as $component_type)
                    <option value="{{$component_type->id}}">{{$component_type->name}}</option>
                @endforeach
            </select>
            <h2>Атрибуты</h2>
            <button  type="button" id="add-attribute">Добавить атрибут</button>
            <input style="height: 60px; width: 120px; margin-top: 10px" class="btn" type="submit" value="Создать">
        </form>
    </div>
@endsection