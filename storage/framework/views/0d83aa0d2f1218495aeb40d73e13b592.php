<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h3 mb-0"><?php echo e(__('messages.chantiers_title')); ?></h1>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary">
                <?php echo e(__('messages.btn_back')); ?>

            </a>
            <a href="<?php echo e(route('chantiers.create')); ?>" class="btn btn-primary">
                <?php echo e(__('messages.chantier_new')); ?>

            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success mb-3"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><?php echo e(__('messages.col_id')); ?></th>
                        <th><?php echo e(__('messages.field_nom')); ?></th>
                        <th><?php echo e(__('messages.col_localite')); ?></th>
                        <th class="text-center"><?php echo e(__('messages.col_incidents_count')); ?></th>
                        <th class="text-end"><?php echo e(__('messages.col_actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $chantiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chantier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="fw-semibold text-muted"><?php echo e($chantier->id); ?></td>
                        <td class="fw-semibold"><?php echo e($chantier->nom); ?></td>
                        <td>
                            <span class="text-muted">📍</span> <?php echo e($chantier->localite); ?>

                        </td>
                        <td class="text-center">
                            <span class="badge bg-<?php echo e($chantier->incidents_count > 0 ? 'danger' : 'secondary'); ?>">
                                <?php echo e($chantier->incidents_count); ?>

                            </span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('chantiers.show', $chantier)); ?>"
                                   class="btn btn-outline-secondary" title="Voir le tableau de bord">
                                    📊
                                </a>
                                <a href="<?php echo e(route('chantiers.edit', $chantier)); ?>"
                                   class="btn btn-outline-primary">
                                    ✏️ <?php echo e(__('messages.btn_edit')); ?>

                                </a>
                                <form action="<?php echo e(route('chantiers.destroy', $chantier)); ?>"
                                      method="POST"
                                      onsubmit="return confirm('<?php echo e(__('messages.chantier_deleted')); ?>')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-outline-danger" type="submit">
                                        🗑 <?php echo e(__('messages.btn_delete')); ?>

                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <?php echo e(__('messages.chantier_none')); ?>

                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/chantiers/index.blade.php ENDPATH**/ ?>