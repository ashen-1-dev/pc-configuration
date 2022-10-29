<header>
    <a href="<?php echo e(URL::route('welcome')); ?>">
        <div class="header-logo">
            <p>Конфигуратор ПК</p>
            <img src="<?php echo e(asset('icons/logo-computer-gear.png')); ?>" width="40" height="40" alt="">
        </div>
    </a>
    <nav>
        <a href="<?php echo e(URL::route('welcome')); ?>" class="first">Главная</a>
        <a href="#">Сборка</a>
        <a href="#">О нас</a>
        <a href="#">FAQ</a>
        <?php if (auth()->guard()->guest()): ?>
            <a href="<?php echo e(URL::route('login-view')); ?>" class="login">Вход/Регистрация</a>
        <?php endif; ?>
        <?php if (auth()->guard()->check()): ?>
            <div class="user-profile">
                <p>Здравствуйте, <?php echo e(Auth::user()->first_name); ?></p>
                <a href="<?php echo e(URL::route('profile')); ?>">Мои профиль</a>
                <a href="<?php echo e(URL::route('logout')); ?>">Выйти</a>
            </div>
        <?php endif; ?>
    </nav>
</header><?php /**PATH G:\Projects\pc-configurator\resources\views/includes/navbar.blade.php ENDPATH**/ ?>
