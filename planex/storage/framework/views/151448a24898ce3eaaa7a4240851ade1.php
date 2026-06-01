<?php $__env->startSection('content'); ?>


<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
<div class="sidebar" id="sidebar">
    <button class="sidebar-close" onclick="closeSidebar()">✕</button>
    <div class="sidebar-logo">
        <img src="<?php echo e(asset('images/Planex.jpg')); ?>" alt="PlanEx">
    </div>
    <div class="sidebar-divider"></div>
    <nav class="sidebar-nav">
        
        <a href="<?php echo e(route('home')); ?>" class="sidebar-link active">
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
                    <a href="<?php echo e(route('users.index')); ?>" class="sidebar-link">
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
}</script>
<div class="home-container">

    <div class="home-title">
        <div align="center">
            <h1>Bienvenue sur PlanEx, toujours une idée d'avance <h1>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/planex/resources/views/home.blade.php ENDPATH**/ ?>