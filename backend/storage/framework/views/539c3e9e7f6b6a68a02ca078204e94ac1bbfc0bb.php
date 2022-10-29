

<?php $__env->startSection('title-block'); ?>Добавить новый компонент<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Добавить новый компонент</h1>
        <form action="<?php echo e(URL::route('components.store', [], false)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <h2>Название компонента</h2>
            <input name="name" id="name">
            <h2>Тип компонента</h2>
            <select style="width: 392px; height: 44px" name="type_id" id="type_id">
                <?php $__currentLoopData = $component_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($component_type->id); ?>"><?php echo e($component_type->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <h2>Атрибуты</h2>
            <button  type="button" id="add-attribute">Добавить атрибут</button>
            <input style="height: 60px; width: 120px; margin-top: 10px" class="btn" type="submit" value="Создать">
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\Projects\pc-configurator\resources\views/component/create.blade.php ENDPATH**/ ?>