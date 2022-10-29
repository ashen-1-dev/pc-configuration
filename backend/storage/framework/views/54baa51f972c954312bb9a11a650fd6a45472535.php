

<?php $__env->startSection('title-block'); ?>тест<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1><?php echo e($component->name); ?> &mdash; <?php echo e($component->type->name); ?></h1>
        <ul class="attributes">
            <?php $__currentLoopData = $component->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <div class="attribute-container">
                        <?php echo e($attribute->name); ?> &mdash; <?php echo e($attribute->pivot->value); ?>

                    </div>

                </li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\Projects\pc-configurator\resources\views/component/show.blade.php ENDPATH**/ ?>