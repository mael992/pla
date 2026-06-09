<?php $__env->startSection('content'); ?>
<div class="container py-4" style="max-width: 900px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0"><?php echo e(__('messages.incident_new')); ?></h1>
        <a href="<?php echo e(route('incidents.index')); ?>" class="btn btn-outline-secondary">
            <?php echo e(__('messages.btn_back')); ?>

        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form action="<?php echo e(route('incidents.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('partials.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><?php echo e(__('messages.incident_create_btn')); ?></button>
                    <a href="<?php echo e(route('incidents.index')); ?>" class="btn btn-outline-secondary"><?php echo e(__('messages.btn_cancel')); ?></a>
                </div>
            </form>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/incidents/create.blade.php ENDPATH**/ ?>