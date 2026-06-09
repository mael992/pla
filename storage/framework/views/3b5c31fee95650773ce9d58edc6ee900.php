<?php $__env->startSection('content'); ?>

<div class="container py-5" style="max-width:600px">
    <h1><?php echo e(__('messages.news_title')); ?></h1>
    <p class="text-muted mt-2"><?php echo e(__('messages.news_coming_p1')); ?></p>
    <p class="text-muted mt-2"><?php echo e(__('messages.news_coming_p2')); ?></p>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/nouveautes.blade.php ENDPATH**/ ?>