@extends('layouts.app')

@section('title-block')Вход/Регистрация@endsection

@section('content')
    <div class="login-container">
        <h1>Авторизaция</h1>
        <form action="/login/auth" method="post">
            @csrf
            <h2>Почтовый адресс</h2>
            <input type="text" name="email" id="email">
            <h2>Пароль</h2>
            <input type="password" name="password" id="password">

            <button class="btn btn-medium" type="submit">Войти</button>
        </form>
    </div>
    <div class="vertical-line"></div>
    <div class="auth-container">
        <h1>Впервые на сайте?</h1>
        <h2 style="text-align: center;">Пройдите регистрацию</h2>
        <form action="/login/register" method="post">
            @csrf
            <h2>Почтовый адрес</h2>
            <input type="text" name="email" id="email">

            <h2>Пароль</h2>
            <input type="password" name="password" id="password">

            <h2>Фамилия</h2>
            <input type="text" name="last_name" id="last_name">

            <h2>Имя</h2>
            <input type="text" name="first_name" id="first_name">

{{--            <h2>Номер группы</h2>--}}
{{--            <input type="text" name="group" id="group">--}}

            <button class="btn btn-medium" type="submit">Зарегистрироваться</button>
        </form>
    </div>
@endsection