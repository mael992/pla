<?php $__env->startSection('content'); ?>

<div class="container-fluid px-3 px-md-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h3 mb-0"><?php echo e(__('messages.users_title')); ?></h1>
        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary">
            <?php echo e(__('messages.user_add')); ?>

        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success mb-3"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger mb-3"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    
    <div class="mb-3" style="max-width:400px">
        <div class="search-input-group">
            <span class="search-icon">🔍</span>
            <input type="text"
                   id="userSearch"
                   class="search-input"
                   placeholder="<?php echo e(__('messages.user_search_placeholder')); ?>"
                   autocomplete="off">
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle" id="usersTable">
                <thead class="table-dark">
                    <tr>
                        <th><?php echo e(__('messages.col_id')); ?></th>
                        <th><?php echo e(__('messages.col_username')); ?></th>
                        <th><?php echo e(__('messages.col_email')); ?></th>
                        <th><?php echo e(__('messages.col_role')); ?></th>
                        <th class="text-end"><?php echo e(__('messages.col_actions')); ?></th>
                    </tr>
                </thead>
                <tbody id="usersBody">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-search="<?php echo e(strtolower($user->username . ' ' . ($user->email ?? '') . ' ' . $user->role)); ?>">
                        <td class="fw-semibold text-muted"><?php echo e($user->id); ?></td>
                        <td>
                            <?php echo e($user->username); ?>

                            <?php if($user->id === auth()->id()): ?>
                                <span class="badge bg-secondary ms-1" style="font-size:10px">Vous</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($user->email ?? '—'); ?></td>
                        <td>
                            <?php
                                $roleColors = ['admin' => 'danger', 'incident' => 'warning', 'user' => 'secondary'];
                                $color = $roleColors[$user->role] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?php echo e($color); ?>"><?php echo e(ucfirst($user->role)); ?></span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-outline-primary">
                                    ✏️ <?php echo e(__('messages.btn_edit')); ?>

                                </a>
                                <?php if($user->must_change_password && $user->role !== 'admin'): ?>
                                <a href="<?php echo e(route('users.courrier', $user->id)); ?>"
                                   class="btn btn-outline-secondary"
                                   title="<?php echo e(__('messages.btn_courrier')); ?>">
                                    📄 PDF
                                </a>
                                <?php endif; ?>
                                <?php if($user->id !== auth()->id()): ?>
                                <form action="<?php echo e(route('users.destroy', $user->id)); ?>"
                                      method="POST"
                                      onsubmit="return confirmDelete('<?php echo e(addslashes($user->username)); ?>')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-outline-danger" type="submit">
                                        🗑 <?php echo e(__('messages.btn_delete')); ?>

                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4"><?php echo e(__('messages.user_none')); ?></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            
            <div id="noResults" class="text-center text-muted py-4 d-none">
                <?php echo e(__('messages.user_none')); ?>

            </div>
        </div>
    </div>

</div>

<script>
/* ── Recherche live ── */
document.getElementById('userSearch').addEventListener('input', function () {
    const q     = this.value.toLowerCase().trim();
    const rows  = document.querySelectorAll('#usersBody tr');
    let visible = 0;

    rows.forEach(row => {
        const data = row.dataset.search ?? '';
        const show = !q || data.includes(q);
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    document.getElementById('noResults').classList.toggle('d-none', visible > 0);
});

/* ── Confirmation suppression ── */
function confirmDelete(username) {
    return confirm(
        '⚠️ Supprimer l\'utilisateur « ' + username + ' » ?\n\n' +
        'Il sera retiré de tous les chantiers et les chefs de chantier concernés seront notifiés par e-mail.'
    );
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/users/index.blade.php ENDPATH**/ ?>