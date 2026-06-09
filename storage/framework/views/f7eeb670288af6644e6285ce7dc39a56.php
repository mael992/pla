<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4 py-4">

    
    <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
        <div>
            <a href="<?php echo e(route('chantiers.index')); ?>" class="text-muted text-decoration-none small">
                ← <?php echo e(__('messages.chantiers_title')); ?>

            </a>
            <h1 class="h3 mb-0 mt-1">🏗️ <?php echo e($chantier->nom); ?></h1>
            <p class="text-muted mb-0">📍 <?php echo e($chantier->localite); ?></p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('chantiers.index')); ?>" class="btn btn-outline-secondary btn-sm">
                <?php echo e(__('messages.btn_back')); ?>

            </a>
            <a href="<?php echo e(route('chantiers.edit', $chantier)); ?>" class="btn btn-outline-primary btn-sm">
                ✏️ <?php echo e(__('messages.btn_edit')); ?>

            </a>
            <a href="<?php echo e(route('dashboard')); ?>?chantier_id=<?php echo e($chantier->id); ?>" class="btn btn-primary btn-sm">
                📋 <?php echo e(__('messages.incidents_title')); ?>

            </a>
        </div>
    </div>

    <div class="row g-4">

        
        <div class="col-12 col-lg-5">

            
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="kpi-card kpi-total">
                        <span class="kpi-value"><?php echo e($incidents->count()); ?></span>
                        <span class="kpi-label"><?php echo e(__('messages.kpi_total')); ?></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="kpi-card kpi-open">
                        <span class="kpi-value"><?php echo e($stats['ouvert'] + $stats['en_cours']); ?></span>
                        <span class="kpi-label"><?php echo e(__('messages.kpi_open')); ?></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="kpi-card kpi-closed">
                        <span class="kpi-value"><?php echo e($stats['fermer']); ?></span>
                        <span class="kpi-label"><?php echo e(__('messages.kpi_closed')); ?></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="kpi-card kpi-progress">
                        <span class="kpi-value">
                            <?php if($incidents->count() > 0): ?>
                                <?php echo e(round($stats['fermer'] / $incidents->count() * 100)); ?>%
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </span>
                        <span class="kpi-label"><?php echo e(__('messages.kpi_closure_rate')); ?></span>
                    </div>
                </div>
            </div>

            
            <?php if($incidents->count() > 0): ?>
            <div class="card shadow-sm">
                <div class="card-body p-3">
                    <h6 class="fw-semibold mb-3 text-center text-muted text-uppercase" style="font-size:11px;letter-spacing:.06em">
                        <?php echo e(__('messages.chart_by_status')); ?>

                    </h6>
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                    
                    <ul class="chart-legend mt-3">
                        <?php $__currentLoopData = array_combine($chartLabels, array_map(null, $chartData, $chartColors)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => [$count, $color]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="chart-legend-item">
                            <span class="chart-legend-dot" style="background:<?php echo e($color); ?>"></span>
                            <span class="chart-legend-label"><?php echo e($label); ?></span>
                            <span class="chart-legend-count"><?php echo e($count); ?></span>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <?php else: ?>
            <div class="card shadow-sm">
                <div class="card-body text-center py-5 text-muted">
                    <div style="font-size:3rem">📭</div>
                    <p class="mt-2 mb-0"><?php echo e(__('messages.incident_none')); ?></p>
                </div>
            </div>
            <?php endif; ?>

        </div>

        
        <div class="col-12 col-lg-7">

            
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <span class="fw-semibold" style="font-size:13px">👥 <?php echo e(__('messages.chantier_members')); ?></span>
                </div>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger m-3 mb-0"><?php echo e($errors->first()); ?></div>
                <?php endif; ?>
                <?php if(session('success')): ?>
                    <div class="alert alert-success m-3 mb-0"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle" style="font-size:13px">
                        <thead class="table-dark">
                            <tr>
                                <th><?php echo e(__('messages.col_member')); ?></th>
                                <th><?php echo e(__('messages.col_role_chantier')); ?></th>
                                <th class="text-end"><?php echo e(__('messages.col_actions')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <span class="fw-semibold"><?php echo e($member->username); ?></span>
                                    <?php if($member->pivot->is_creator): ?>
                                        <span class="badge bg-warning ms-1" style="font-size:10px"><?php echo e(__('messages.col_creator')); ?></span>
                                    <?php endif; ?>
                                    <?php if($member->email): ?>
                                        <div class="text-muted" style="font-size:11px"><?php echo e($member->email); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    
                                    <form action="<?php echo e(route('chantiers.users.update', [$chantier, $member])); ?>" method="POST">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                        <div class="d-flex gap-1 align-items-center">
                                            <select name="role_chantier" class="form-select form-select-sm" style="font-size:12px">
                                                <?php $__currentLoopData = \App\Models\Chantier::ROLES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>" <?php echo e($member->pivot->role_chantier === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <button class="btn btn-outline-primary btn-sm" type="submit" title="<?php echo e(__('messages.btn_save')); ?>">✓</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <?php if(!$member->pivot->is_creator): ?>
                                    <form action="<?php echo e(route('chantiers.users.remove', [$chantier, $member])); ?>" method="POST"
                                          onsubmit="return confirm('Retirer <?php echo e($member->username); ?> ?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-outline-danger btn-sm" type="submit">✕</button>
                                    </form>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size:11px">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                
                <?php if($allUsers->isNotEmpty()): ?>
                <div class="card-body border-top pt-3 pb-3">
                    <p class="fw-semibold mb-2" style="font-size:13px">➕ <?php echo e(__('messages.chantier_add_member')); ?></p>
                    <form action="<?php echo e(route('chantiers.users.add', $chantier)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row g-2 align-items-end">
                            <div class="col-12 col-sm-5">
                                <label class="form-label" style="font-size:12px"><?php echo e(__('messages.col_member')); ?></label>
                                <select name="user_id" class="form-select form-select-sm" required>
                                    <option value=""><?php echo e(__('messages.chantier_member_search')); ?></option>
                                    <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($u->id); ?>"><?php echo e($u->username); ?><?php echo e($u->email ? ' ('.$u->email.')' : ''); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-12 col-sm-5">
                                <label class="form-label" style="font-size:12px"><?php echo e(__('messages.chantier_role')); ?></label>
                                <select name="role_chantier" class="form-select form-select-sm" required>
                                    <?php $__currentLoopData = \App\Models\Chantier::ROLES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($label); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-12 col-sm-2">
                                <button class="btn btn-primary btn-sm w-100" type="submit"><?php echo e(__('messages.btn_add')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>

            
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <span class="fw-semibold" style="font-size:13px">
                        <?php echo e(__('messages.chantier_anomalies')); ?>

                    </span>
                    <a href="<?php echo e(route('incidents.create')); ?>" class="btn btn-primary btn-sm">
                        + <?php echo e(__('messages.incident_add')); ?>

                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle" style="font-size:13px">
                        <thead class="table-dark">
                            <tr>
                                <th><?php echo e(__('messages.col_id')); ?></th>
                                <th><?php echo e(__('messages.col_discipline')); ?></th>
                                <th><?php echo e(__('messages.col_issued_on')); ?></th>
                                <th><?php echo e(__('messages.col_status')); ?></th>
                                <th class="text-end"><?php echo e(__('messages.col_actions')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $incidents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incident): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $badgeMap = [
                                    'na'       => ['secondary', __('messages.status_na')],
                                    'ouvert'   => ['danger',    __('messages.status_open')],
                                    'en_cours' => ['warning',   __('messages.status_in_progress')],
                                    'fermer'   => ['success',   __('messages.status_closed')],
                                ];
                                $b = $badgeMap[$incident->statut] ?? ['secondary', $incident->statut];
                            ?>
                            <tr>
                                <td>
                                    <span class="badge-ref">
                                        <?php echo e($incident->reference ?? '#'.$incident->id_incident); ?>

                                    </span>
                                </td>
                                <td><?php echo e($incident->discipline ?? '—'); ?></td>
                                <td class="text-muted">
                                    <?php echo e($incident->date_emis
                                        ? \Carbon\Carbon::parse($incident->date_emis)->format('d/m/Y')
                                        : '—'); ?>

                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($b[0]); ?>"><?php echo e($b[1]); ?></span>
                                </td>
                                <td class="text-end">
                                    <a href="<?php echo e(route('incidents.show', $incident->id_incident)); ?>"
                                       class="btn btn-outline-secondary btn-sm">
                                        <?php echo e(__('messages.btn_view')); ?>

                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <?php echo e(__('messages.incident_none')); ?>

                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
<?php if($incidents->count() > 0): ?>
(function () {
    const labels = <?php echo json_encode($chartLabels, 15, 512) ?>;
    const data   = <?php echo json_encode($chartData, 15, 512) ?>;
    const colors = <?php echo json_encode($chartColors, 15, 512) ?>;

    const ctx = document.getElementById('statusChart').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data,
                backgroundColor: colors,
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '58%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const pct   = Math.round(ctx.parsed / total * 100);
                            return ` ${ctx.label} : ${ctx.parsed} (${pct}%)`;
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                duration: 700,
                easing: 'easeInOutQuart',
            }
        }
    });
})();
<?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/chantiers/show.blade.php ENDPATH**/ ?>