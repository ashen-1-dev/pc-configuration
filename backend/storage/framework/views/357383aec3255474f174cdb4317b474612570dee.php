
<?php $__env->startSection('title-block'); ?>Список компонентов<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <a href="<?php echo e(URL::route('components.create')); ?>">Добавить</a>
        <h1>Компоненты</h1>
            <ul class="component-list">
                <?php $__currentLoopData = $components; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(URL::route('components.show', $component->id, false)); ?>">
                        <?php echo e($component->name); ?> (<?php echo e($component->type->name); ?>) &mdash;
                        <form class="delete-button" action="<?php echo e(URL::route('components.destroy', $component->id, false)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                            <button type="submit">Удалить</button>
                        </form>
                        <form
                                style="display: inline"
                                action="<?php echo e(URL::route('components.edit', $component->id, false)); ?>"
                                method="get">
                            <button type="submit">Изменить</button>
                        </form>
                    </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\Projects\pc-configurator\resources\views/component/index.blade.php ENDPATH**/ ?>