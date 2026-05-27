<?php $__env->startSection('content'); ?>


<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
<div class="sidebar" id="sidebar">
    <button class="sidebar-close" onclick="closeSidebar()">✕</button>
    <div class="sidebar-logo">
        <img src="<?php echo e(asset('images/Planex.jpg')); ?>" alt="PlanEx">
    </div>
    <div class="sidebar-divider"></div>
    <nav class="sidebar-nav">
        
        <a href="<?php echo e(route('home')); ?>" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">🏠️</span> Accueil
        </a>
        <a href="<?php echo e(route('infos')); ?>" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">ℹ️</span> Infos
        </a>
        <a href="<?php echo e(route('contact')); ?>" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">📞</span> Contact
        </a>
        <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->isAdmin() || auth()->user()->isIncident()): ?>
        <a href="<?php echo e(route('incidents.index')); ?>" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">📋</span> Incidents
        </a>
        <?php endif; ?>
    </nav>
    <?php if(auth()->user()->isAdmin()): ?>
        <div class="sidebar-divider"></div>
        <a href="<?php echo e(route('users.create')); ?>" class="sidebar-cta">
            <span style="font-size:16px">➕</span> Ajouter un utilisateur
        </a>
        <?php endif; ?>
    <div class="sidebar-divider"></div>
    <div class="sidebar-footer">
        <div class="sidebar-footer-item">
            <span style="font-size:16px">👤</span>
            <span><?php echo e(auth()->user()->username ?? '—'); ?></span>
        </div>
        <div class="sidebar-footer-item">
            <span style="font-size:16px">🔰</span>
            <span><?php echo e(ucfirst(auth()->user()->role ?? 'user')); ?></span>
        </div>
          
        <?php if(auth()->user()->isAdmin()): ?>
        <div class="sidebar-divider"></div>
                    <a href="<?php echo e(route('users.index')); ?>" class="sidebar-link  active">
            <span class="sidebar-icon" style="font-size:16px">🛠️</span> Gérer les comptes d'utilisateur
        </a>
                <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

    <button class="sidebar-toggle" onclick="openSidebar()">☰</button><script>
    function setLiveStatus(online) {
    const el = document.getElementById('liveIndicator');
    if (!el) return;
    el.classList.toggle('live-offline', !online);
}

function openSidebar() {
    document.getElementById('sidebar').classList.add('open');
    document.getElementById('sidebarOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('show');
    document.body.style.overflow = '';
}
</script>
<h1>Gestion des utilisateurs</h1>


<table class="table">
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Role</th>
    <th>Actions</th>
</tr>

<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($user->id); ?></td>
    <td><?php echo e($user->username); ?></td>
    <td><?php echo e($user->role); ?></td>
    <td>
        <a href="<?php echo e(route('users.edit', $user->id)); ?>">✏️</a>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/planex/resources/views/users/index.blade.php ENDPATH**/ ?>