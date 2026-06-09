<?php $__env->startSection('content'); ?>

<div class="container py-5" style="max-width: 760px;">

    <h1 class="mb-4"><?php echo e(__('messages.infos_title')); ?></h1>

    <div class="infos-content">
        <p><?php echo e(__('messages.infos_p1')); ?></p>
        <p><?php echo e(__('messages.infos_p2')); ?></p>
        <p><?php echo e(__('messages.infos_p3')); ?></p>
        <p><strong><?php echo e(__('messages.infos_p4')); ?></strong></p>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/infos.blade.php ENDPATH**/ ?>