

<?php $__env->startSection('title-block'); ?>Мой профиль<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Мои сборки</h1>
        <?php $__currentLoopData = $builds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $build): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($build->name); ?></p>
            <?php $__currentLoopData = $build->components; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($component->name); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\Projects\pc-configurator\resources\views/user/profile.blade.php ENDPATH**/ ?>