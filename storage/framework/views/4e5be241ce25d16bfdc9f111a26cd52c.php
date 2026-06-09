<?php $__env->startSection('title', 'Logs d\'activité — Admin PlanEx'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4 py-4">

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h2 class="fw-bold mb-0" style="font-size:1.3rem;">📋 Logs d'activité</h2>
            <p class="text-muted small mb-0">
                Conservation : 6 mois (conformité CNIL/RGPD) — Sauvegarde automatique toutes les 48h
            </p>
        </div>
        <?php if($selected): ?>
        <a href="<?php echo e(route('admin.logs.download', ['file' => $selected])); ?>"
           class="btn btn-outline-dark btn-sm">
            ⬇️ Télécharger ce fichier
        </a>
        <?php endif; ?>
    </div>

    <div class="row g-3">

        
        <div class="col-12 col-md-3">

            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header py-2 px-3" style="background:#111;color:white;font-size:13px;font-weight:600;">
                    Fichiers de logs
                </div>
                <div class="list-group list-group-flush">
                    <?php $__empty_1 = true; $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php $fname = basename($f); ?>
                        <a href="<?php echo e(route('admin.logs.index', ['file' => $fname, 'cat' => $filterCat, 'q' => $filterText])); ?>"
                           class="list-group-item list-group-item-action py-2 px-3 <?php echo e($selected === $fname ? 'active' : ''); ?>"
                           style="font-size:13px;">
                            <?php echo e($fname); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="list-group-item text-muted small py-2 px-3">Aucun fichier</div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(!empty($backups)): ?>
            <div class="card border-0 shadow-sm">
                <div class="card-header py-2 px-3" style="background:#555;color:white;font-size:12px;font-weight:600;">
                    Sauvegardes (48h)
                </div>
                <div class="list-group list-group-flush" style="max-height:200px;overflow-y:auto;">
                    <?php $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item py-1 px-3" style="font-size:11px;color:#555;">
                            📦 <?php echo e($backup); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>

        </div>

        
        <div class="col-12 col-md-9">

            
            <form method="GET" action="<?php echo e(route('admin.logs.index')); ?>" class="card border-0 shadow-sm mb-3">
                <div class="card-body py-2 px-3">
                    <div class="row g-2 align-items-end">
                        <input type="hidden" name="file" value="<?php echo e($selected); ?>">
                        <div class="col-12 col-sm-4">
                            <label class="form-label small fw-semibold mb-1">Catégorie</label>
                            <select name="cat" class="form-select form-select-sm">
                                <option value="">Toutes</option>
                                <?php $__currentLoopData = ['AUTH','USER','TICKET','INCIDENT','CHANTIER','SYSTEM']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat); ?>" <?php echo e($filterCat === $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label small fw-semibold mb-1">Recherche</label>
                            <input type="text" name="q" class="form-control form-control-sm"
                                   placeholder="Nom, IP, action..." value="<?php echo e($filterText); ?>">
                        </div>
                        <div class="col-12 col-sm-2">
                            <button type="submit" class="btn btn-dark btn-sm w-100">Filtrer</button>
                        </div>
                    </div>
                </div>
            </form>

            
            <div class="card border-0 shadow-sm">
                <div class="card-header py-2 px-3 d-flex justify-content-between align-items-center"
                     style="background:#f8f9fa;font-size:13px;">
                    <span class="fw-semibold"><?php echo e($selected ?? 'Aucun fichier sélectionné'); ?></span>
                    <span class="text-muted small"><?php echo e(count($lines)); ?> ligne(s)</span>
                </div>
                <div class="card-body p-0">
                    <?php if(empty($lines)): ?>
                        <div class="text-center text-muted py-5">Aucune entrée à afficher.</div>
                    <?php else: ?>
                        <div style="overflow-x:auto;max-height:600px;overflow-y:auto;">
                            <table class="table table-sm mb-0" style="font-size:12px;font-family:monospace;">
                                <tbody>
                                <?php $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        // Colorisation selon catégorie
                                        $color = '#333';
                                        if (str_contains($line, '[AUTH]'))     $color = '#1a56db';
                                        if (str_contains($line, '[USER]'))     $color = '#7e3af2';
                                        if (str_contains($line, '[TICKET]'))   $color = '#c27803';
                                        if (str_contains($line, '[INCIDENT]')) $color = '#e02424';
                                        if (str_contains($line, '[CHANTIER]')) $color = '#057a55';
                                        if (str_contains($line, '[SYSTEM]'))   $color = '#6b7280';
                                    ?>
                                    <tr>
                                        <td style="color:<?php echo e($color); ?>;white-space:nowrap;padding:3px 12px;border:none;line-height:1.5;">
                                            <?php echo e($line); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/admin/logs/index.blade.php ENDPATH**/ ?>