<?php $__env->startSection('content'); ?>
<div class="container py-4" style="max-width: 860px;">

    
    <div class="mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
            <div>
                <h1 class="h4 mb-1 fw-bold">
                    <?php echo e($incident->reference ?? 'ANO-#'.$incident->id_incident); ?>

                </h1>
                <span class="text-muted small"><?php echo e(__('messages.incident_issued_by')); ?> <strong><?php echo e($incident->emis_par ?? '—'); ?></strong></span>
            </div>
            <?php
                $badgeMap = [
                    'na'      => ['secondary', __('messages.status_na')],
                    'ouvert'  => ['danger',    __('messages.status_open')],
                    'en_cours'=> ['warning',   __('messages.status_in_progress')],
                    'fermer'  => ['success',   __('messages.status_closed')],
                ];
                $b = $badgeMap[$incident->statut] ?? ['secondary', ucfirst($incident->statut)];
            ?>
            <span class="badge bg-<?php echo e($b[0]); ?> fs-6 px-3 py-2"><?php echo e($b[1]); ?></span>
        </div>
    </div>

    
    <div class="card shadow-sm mb-3">
        <div class="card-header fw-semibold"><?php echo e(__('messages.section_general_info')); ?></div>
        <div class="card-body p-0">
            <dl class="info-grid mb-0">
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_discipline')); ?></dt>
                    <dd><?php echo e($incident->discipline ?? '—'); ?></dd>
                </div>
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_system')); ?></dt>
                    <dd><?php echo e($incident->systeme ?? '—'); ?></dd>
                </div>
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_work_lot')); ?></dt>
                    <dd><?php echo e($incident->lot_travail ?? '—'); ?></dd>
                </div>
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_zone')); ?></dt>
                    <dd><?php echo e($incident->zoneobj->name ?? '—'); ?></dd>
                </div>
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_chantier')); ?></dt>
                    <dd>
                        <?php if($incident->chantier): ?>
                            <span><?php echo e($incident->chantier->nom); ?></span>
                            <span class="text-muted small ms-1">📍 <?php echo e($incident->chantier->localite); ?></span>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </dd>
                </div>
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_label')); ?></dt>
                    <dd><?php echo e($incident->etiquette ?? '—'); ?></dd>
                </div>
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_category')); ?></dt>
                    <dd><?php echo e($incident->categorie_label ?? '—'); ?></dd>
                </div>
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_internal')); ?></dt>
                    <dd><?php echo e($incident->interne ?? '—'); ?></dd>
                </div>
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_responsibility')); ?></dt>
                    <dd><?php echo e($incident->responsabilite ?? '—'); ?></dd>
                </div>
            </dl>
        </div>
    </div>

    
    <div class="card shadow-sm mb-3">
        <div class="card-header fw-semibold"><?php echo e(__('messages.section_tracking')); ?></div>
        <div class="card-body">
            <div class="row g-3">
                <?php $__currentLoopData = [
                    __('messages.field_issued_on')       => $incident->date_emis,
                    __('messages.field_updated_on')      => $incident->date_maj,
                    __('messages.field_closed_on')       => $incident->date_cloture,
                    __('messages.field_planned_closure') => $incident->cloture_prevue,
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-sm-3">
                    <div class="date-chip">
                        <span class="date-chip-label"><?php echo e($label); ?></span>
                        <span class="date-chip-value">
                            <?php echo e($date ? \Carbon\Carbon::parse($date)->format('d/m/Y') : '—'); ?>

                        </span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="card shadow-sm mb-3">
        <div class="card-header fw-semibold"><?php echo e(__('messages.section_description')); ?></div>
        <div class="card-body">
            <p class="mb-0" style="white-space: pre-wrap; line-height: 1.6;">
                <?php echo e($incident->description ?? '—'); ?>

            </p>
        </div>
    </div>

    
    <div class="card shadow-sm mb-3">
        <div class="card-header fw-semibold"><?php echo e(__('messages.section_qfc')); ?></div>
        <div class="card-body p-0">
            <dl class="info-grid mb-0">
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_qfc_open')); ?></dt>
                    <dd><?php echo e($incident->qfc_ouvert ?? '—'); ?></dd>
                </div>
                <div class="info-row">
                    <dt><?php echo e(__('messages.field_qfc_closed')); ?></dt>
                    <dd><?php echo e($incident->qfc_ferme ?? '—'); ?></dd>
                </div>
            </dl>
        </div>
    </div>

    
    <?php if($incident->photo_ouverte || $incident->photo_fermee): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-semibold"><?php echo e(__('messages.section_photos')); ?></div>
        <div class="card-body">
            <div class="row g-3">
                <?php if($incident->photo_ouverte): ?>
                <div class="col-12 col-sm-6">
                    <p class="text-muted small fw-semibold mb-2"><?php echo e(__('messages.field_photo_open')); ?></p>
                    <a href="<?php echo e(asset('storage/'.$incident->photo_ouverte)); ?>" target="_blank">
                        <img src="<?php echo e(asset('storage/'.$incident->photo_ouverte)); ?>"
                             class="img-fluid rounded border w-100"
                             style="object-fit: cover; max-height: 260px;">
                    </a>
                </div>
                <?php endif; ?>
                <?php if($incident->photo_fermee): ?>
                <div class="col-12 col-sm-6">
                    <p class="text-muted small fw-semibold mb-2"><?php echo e(__('messages.field_photo_closed')); ?></p>
                    <a href="<?php echo e(asset('storage/'.$incident->photo_fermee)); ?>" target="_blank">
                        <img src="<?php echo e(asset('storage/'.$incident->photo_fermee)); ?>"
                             class="img-fluid rounded border w-100"
                             style="object-fit: cover; max-height: 260px;">
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?php echo e(route('incidents.index')); ?>" class="btn btn-outline-secondary">
            <?php echo e(__('messages.btn_back')); ?>

        </a>
        <?php if($incident->statut !== 'fermer'): ?>
            <a href="<?php echo e(route('incidents.edit', $incident->id_incident)); ?>" class="btn btn-primary">
                <?php echo e(__('messages.btn_edit')); ?>

            </a>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/incidents/show.blade.php ENDPATH**/ ?>