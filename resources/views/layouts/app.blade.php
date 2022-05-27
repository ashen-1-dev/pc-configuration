<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('styles/reset.css')}}">
    <link rel="stylesheet" href="{{asset('styles/style.css')}}">
    <title>@yield('title-block')</title>
</head>
<body>
    @include('includes.header')
    <main>
        @yield('content')
        <script src="{{asset('js/script.js')}}"></script>
    </main>
</body>
</html>