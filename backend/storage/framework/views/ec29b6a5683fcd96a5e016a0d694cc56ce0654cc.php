<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('styles/reset.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('styles/style.css')); ?>">
    <title><?php echo $__env->yieldContent('title-block'); ?></title>
</head>
<body>
    <?php echo $__env->make('includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main>
        <?php echo $__env->yieldContent('content'); ?>
        <script src="<?php echo e(asset('js/script.js')); ?>"></script>
    </main>
</body>
</html><?php /**PATH G:\Projects\pc-configurator\resources\views/layouts/app.blade.php ENDPATH**/ ?>
