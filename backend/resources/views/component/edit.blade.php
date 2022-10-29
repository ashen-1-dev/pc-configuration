@extends("layouts.app")

@section('title-block')Изменить компонент@endsection

@section('content')
    <div class="container">
        <h1>Изменить компонент</h1>
        <form action="{{URL::route('components.update', $component->id, false)}}" method="post">
            @csrf
            @method('put')
            <h2>Название компонента</h2>
            <input name="name" id="name" value="{{$component->name}}">
            <h2>Тип компонента</h2>
            <select style="width: 392px; height: 44px" name="type_id" id="type_id">
                @foreach($component_types as $component_type)
                    @if($component->type->name === $component_type->name)
                        <option selected="selected" value="{{$component_type->id}}">{{$component_type->name}}</option>
                    @endif
                    <option value="{{$component_type->id}}">{{$component_type->name}}</option>
                @endforeach
            </select>
            <h2>Атрибуты</h2>
            @foreach($component->attributes as $i => $attribute)
                <div class="attribute-item">
                    <input type="text"
                           placeholder="Название характеристики"
                           name="attributes[{{$i}}][name]"
                           value="{{$attribute->name}}">
                    <input
                            type="text"
                            placeholder="Значение"
                            name="attributes[{{$i}}][value]"
                            value="{{$attribute->pivot->value}}">
                </div>
            @endforeach
            <button  type="button" id="add-attribute">Добавить атрибут</button>
            <input style="height: 60px; width: 120px; margin-top: 10px" class="btn" type="submit" value="Создать">
        </form>
    </div>
@endsection