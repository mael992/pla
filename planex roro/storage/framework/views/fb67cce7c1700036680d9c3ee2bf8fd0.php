<nav class="navbar">
    <div class="navbar-container">

        
        <a href="<?php echo e(route('home')); ?>" class="logo">
            <img src="<?php echo e(asset('images/Planex.jpg')); ?>" alt="PlanEx">
        </a>

        
        <div class="nav-auth">

            <?php if(auth()->guard()->check()): ?>
                <div class="nav-sep"></div>

                <span class="user">
                    <span class="user-dot"></span>
                    <?php echo e(auth()->user()->username); ?>

                </span>

                <div class="nav-sep"></div>

                

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-logout">Déconnexion</button>
                </form>
            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="btn-login">Connexion</a>
            <?php endif; ?>

        </div>
    </div>
</nav>


<div class="nav-mobile-overlay" id="navMobileOverlay"
     onclick="closeNavMenu()"></div>

<div class="nav-mobile-menu" id="navMobileMenu">

    <div class="nav-mobile-header">
        <img src="<?php echo e(asset('images/Planex.jpg')); ?>" alt="PlanEx" style="height:36px;">
        <button onclick="closeNavMenu()" class="nav-mobile-close">✕</button>
    </div>

    <nav class="nav-mobile-links">
        <a href="<?php echo e(route('home')); ?>">Accueil</a>
        <a href="<?php echo e(route('infos')); ?>">Infos</a>
        <a href="#">Nouveautés</a>
        <a href="#">Contact</a>

        <?php if(auth()->guard()->check()): ?>
            <?php if(auth()->user()->isAdmin() || auth()->user()->isIncident()): ?>
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-mobile-special">
                    Tableau des anomalies
                </a>
            <?php endif; ?>
            <?php if(auth()->user()->isAdmin()): ?>
                <a href="<?php echo e(route('users.index')); ?>">Gestion users</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>

</div>

<script>
function openNavMenu() {
    document.getElementById('navMobileMenu').classList.add('open');
    document.getElementById('navMobileOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeNavMenu() {
    document.getElementById('navMobileMenu').classList.remove('open');
    document.getElementById('navMobileOverlay').classList.remove('show');
    document.body.style.overflow = '';
}
</script>
<?php /**PATH /var/www/planex/resources/views/partials/navbar.blade.php ENDPATH**/ ?>