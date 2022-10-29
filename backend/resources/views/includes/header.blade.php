<header>
    <a href="{{URL::route('welcome')}}">
        <div class="header-logo">
            <p>Конфигуратор ПК</p>
            <img src="{{asset('icons/logo-computer-gear.png')}}" width="40" height="40" alt="">
        </div>
    </a>
    <nav>
        <a href="{{URL::route('welcome')}}" class="first">Главная</a>
        <a href="#">Сборка</a>
        <a href="#">О нас</a>
        <a href="#">FAQ</a>
        @guest
        <a href="{{URL::route('login-view')}}" class="login">Вход/Регистрация</a>
        @endguest
        @auth
            <div class="user-profile">
                <p>Здравствуйте, {{Auth::user()->first_name}}</p>
                <a href="{{URL::route('profile')}}">Мои профиль</a>
                <a href="{{URL::route('logout')}}">Выйти</a>
            </div>
        @endauth
    </nav>
</header>