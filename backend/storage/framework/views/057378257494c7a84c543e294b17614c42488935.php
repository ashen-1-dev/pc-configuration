

<?php $__env->startSection('title-block'); ?>Вход/Регистрация<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="login-container">
        <h1>Авторизaция</h1>
        <form action="<?php echo e(URL::route('login', [], false)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <h2>Почтовый адрес</h2>
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
        <form action="<?php echo e(URL::route('register', [], false)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <h2>Почтовый адрес</h2>
            <input type="text" name="email" id="email">

            <h2>Пароль</h2>
            <input type="password" name="password" id="password">

            <h2>Фамилия</h2>
            <input type="text" name="last_name" id="last_name">

            <h2>Имя</h2>
            <input type="text" name="first_name" id="first_name">




            <button class="btn btn-medium" type="submit">Зарегистрироваться</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\pc-configurator\resources\views/login.blade.php ENDPATH**/ ?>