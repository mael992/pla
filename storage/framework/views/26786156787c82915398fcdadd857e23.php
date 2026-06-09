<?php $__env->startSection('title', 'Messages — Admin PlanEx'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="fw-bold mb-0" style="font-size:1.4rem;">Tickets de support</h2>
        <span class="badge bg-secondary"><?php echo e($tickets->count()); ?> ticket(s)</span>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($tickets->isEmpty()): ?>
        <div class="text-center text-muted py-5">
            <p style="font-size:1.1rem;">Aucun ticket pour le moment.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle border rounded" style="background:white;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th style="width:40px;" class="text-center">État</th>
                        <th style="width:100px;">N°</th>
                        <th>Sujet</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center">
                            <?php if($ticket->statut === 'cloture'): ?>
                                <span title="Clôturé" style="color:#6c757d;font-size:1.1rem;">&#9632;</span>
                            <?php else: ?>
                                <span title="Ouvert" style="color:#28a745;font-size:1.1rem;">&#9633;</span>
                            <?php endif; ?>
                        </td>
                        <td class="fw-semibold text-muted small"><?php echo e($ticket->numero); ?></td>
                        <td>
                            <?php if($ticket->statut === 'reouverture_demandee'): ?>
                                <span title="Réouverture demandée" class="me-1">&#9888;</span>
                            <?php endif; ?>
                            <?php echo e($ticket->question_1); ?>

                            <div class="text-muted" style="font-size:0.82rem;"><?php echo e($ticket->question_2); ?></div>
                        </td>
                        <td class="small text-muted"><?php echo e($ticket->email); ?></td>
                        <td>
                            <?php if($ticket->statut === 'ouvert'): ?>
                                <span class="badge bg-success">Ouvert</span>
                            <?php elseif($ticket->statut === 'cloture'): ?>
                                <span class="badge bg-secondary">Clôturé</span>
                            <?php elseif($ticket->statut === 'reouverture_demandee'): ?>
                                <span class="badge bg-warning text-dark">Réouverture demandée</span>
                            <?php endif; ?>
                        </td>
                        <td class="small text-muted"><?php echo e($ticket->created_at->format('d/m/Y H:i')); ?></td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="<?php echo e(route('admin.tickets.show', $ticket)); ?>" class="btn btn-sm btn-outline-dark">Voir</a>
                                <?php if($ticket->statut !== 'cloture'): ?>
                                    <form method="POST" action="<?php echo e(route('admin.tickets.close', $ticket)); ?>"
                                          onsubmit="return confirm('Clôturer ce ticket ?')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Clôturer</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/admin/tickets/index.blade.php ENDPATH**/ ?>