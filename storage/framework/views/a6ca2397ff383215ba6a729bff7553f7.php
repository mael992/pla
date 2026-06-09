<?php
    $locale = app()->getLocale();
    $flagCodes  = ['fr' => 'fr', 'en' => 'gb', 'it' => 'it', 'es' => 'es'];
    $langLabels = ['fr' => 'FR', 'en' => 'EN', 'it' => 'IT', 'es' => 'ES'];
    $langNames  = ['fr' => 'Français', 'en' => 'English', 'it' => 'Italiano', 'es' => 'Español'];

    $hasAccess  = auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isIncident());
    $isLoggedIn = auth()->check();
    $isUser     = $isLoggedIn && auth()->user()->role === 'user';

    // Lien tableau : dashboard si accès, tarifs sinon
    $tableauHref = $hasAccess ? route('dashboard') : route('tarifs');

    $tableauLinks = [
        ['label' => __('messages.nav_dashboard'),        'href' => $tableauHref,   'featured' => true ],
        ['label' => __('messages.nav_tab_engineering'),  'href' => '#',            'featured' => false],
        ['label' => __('messages.nav_tab_development'),  'href' => '#',            'featured' => false],
        ['label' => __('messages.nav_tab_precom'),       'href' => '#',            'featured' => false],
        ['label' => __('messages.nav_tab_operations'),   'href' => '#',            'featured' => false],
        ['label' => __('messages.nav_tab_support'),      'href' => '#',            'featured' => false],
    ];
?>

<nav class="navbar">
    <div class="navbar-container">

        
        <a href="<?php echo e(route('home')); ?>" class="logo">
            <img src="<?php echo e(asset('images/Planex.jpg')); ?>" alt="PlanEx">
        </a>

        
        <ul class="nav-links-desktop">
            <li><a href="<?php echo e(route('home')); ?>"><?php echo e(__('messages.nav_home')); ?></a></li>
            <li><a href="<?php echo e(route('infos')); ?>"><?php echo e(__('messages.nav_infos')); ?></a></li>
            <li><a href="<?php echo e(route('nouveautes')); ?>"><?php echo e(__('messages.nav_news')); ?></a></li>
            <li><a href="<?php echo e(route('contact')); ?>"><?php echo e(__('messages.nav_contact')); ?></a></li>

            
            <?php if($isLoggedIn): ?>
            <li class="nav-dropdown" id="tableauDropdown">
                <button class="nav-dropdown-trigger" type="button"
                        onclick="toggleDropdown('tableauMenu')" aria-haspopup="true">
                    <?php echo e(__('messages.nav_tableau_label')); ?>

                    <span class="nav-dropdown-arrow" id="tableauArrow">▾</span>
                </button>
                <ul class="nav-dropdown-menu" id="tableauMenu">
                    <?php $__currentLoopData = $tableauLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e($item['href']); ?>"
                               class="<?php echo e($item['featured'] ? 'nav-dropdown-featured' : ''); ?>"
                               onclick="closeAllDropdowns()">
                                <?php echo e($item['label']); ?>

                                <?php if($item['featured'] && $isUser): ?>
                                    <span style="font-size:10px;margin-left:4px;opacity:0.7">🔒</span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>

        
        <div class="nav-right">

            <?php if(auth()->guard()->check()): ?>
                <div class="nav-desktop-auth">
                    <span class="user">
                        <span class="user-dot"></span>
                        <?php echo e(auth()->user()->username); ?>

                    </span>
                    <div class="nav-sep"></div>
                    <?php if($hasAccess): ?>
                        <a href="<?php echo e(route('chantiers.index')); ?>" class="btn-nav-users">
                            <?php echo e(__('messages.nav_chantiers')); ?>

                        </a>
                        <div class="nav-sep"></div>
                    <?php endif; ?>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('users.index')); ?>" class="btn-nav-users">
                            <?php echo e(__('messages.nav_manage_users')); ?>

                        </a>
                        <div class="nav-sep"></div>
                        <a href="<?php echo e(route('admin.tickets.index')); ?>" class="btn-nav-users">
                            Messages
                        </a>
                        <div class="nav-sep"></div>
                        <a href="<?php echo e(route('admin.logs.index')); ?>" class="btn-nav-users">
                            Logs
                        </a>
                        <div class="nav-sep"></div>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-logout"><?php echo e(__('messages.nav_logout')); ?></button>
                    </form>
                    <div class="nav-sep"></div>
                </div>
            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
                <div class="nav-desktop-auth">
                    
                    <a href="<?php echo e(route('tarifs')); ?>" class="btn-buy">
                        <?php echo e(__('messages.nav_buy')); ?>

                    </a>
                    <div class="nav-sep"></div>
                    <a href="<?php echo e(route('login')); ?>" class="btn-login"><?php echo e(__('messages.nav_login')); ?></a>
                    <div class="nav-sep"></div>
                </div>
            <?php endif; ?>

            
            <div class="lang-dropdown" id="langDropdown">
                <button class="lang-dropdown-trigger" type="button"
                        onclick="toggleDropdown('langMenu')">
                    <span class="fi fi-<?php echo e($flagCodes[$locale] ?? 'fr'); ?>"></span>
                    <span class="lang-code"><?php echo e($langLabels[$locale] ?? 'FR'); ?></span>
                    <span class="lang-arrow">▾</span>
                </button>
                <ul class="nav-dropdown-menu lang-dropdown-menu" id="langMenu">
                    <?php $__currentLoopData = $flagCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $iso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('lang.switch', $code)); ?>"
                               class="<?php echo e($locale === $code ? 'lang-option-active' : ''); ?>"
                               onclick="closeAllDropdowns()">
                                <span class="fi fi-<?php echo e($iso); ?>"></span>
                                <span><?php echo e($langNames[$code]); ?></span>
                                <?php if($locale === $code): ?><span class="lang-check">✓</span><?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            
            <button class="nav-hamburger" onclick="openNavMenu()" aria-label="Menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>

        </div>
    </div>
</nav>


<div class="nav-mobile-overlay" id="navMobileOverlay" onclick="closeNavMenu()"></div>
<div class="nav-mobile-menu" id="navMobileMenu" role="dialog">

    <div class="nav-mobile-header">
        <img src="<?php echo e(asset('images/Planex.jpg')); ?>" alt="PlanEx" style="height:34px;">
        <button onclick="closeNavMenu()" class="nav-mobile-close">✕</button>
    </div>

    <?php if(auth()->guard()->check()): ?>
        <div class="nav-mobile-user">
            <span class="user-dot"></span>
            <span class="nav-mobile-username"><?php echo e(auth()->user()->username); ?></span>
            <span class="nav-mobile-role"><?php echo e(ucfirst(auth()->user()->role)); ?></span>
        </div>
        <div class="nav-mobile-divider"></div>
    <?php endif; ?>

    <nav class="nav-mobile-links">
        <a href="<?php echo e(route('home')); ?>"    onclick="closeNavMenu()"><span class="nav-mobile-icon">🏠</span><?php echo e(__('messages.nav_home')); ?></a>
        <a href="<?php echo e(route('infos')); ?>"   onclick="closeNavMenu()"><span class="nav-mobile-icon">ℹ️</span><?php echo e(__('messages.nav_infos')); ?></a>
        <a href="<?php echo e(route('nouveautes')); ?>" onclick="closeNavMenu()"><span class="nav-mobile-icon">🆕</span><?php echo e(__('messages.nav_news')); ?></a>
        <a href="<?php echo e(route('contact')); ?>" onclick="closeNavMenu()"><span class="nav-mobile-icon">✉️</span><?php echo e(__('messages.nav_contact')); ?></a>

        
        <?php if($isLoggedIn): ?>
            <div class="nav-mobile-divider"></div>
            <div class="nav-mobile-section-label"><?php echo e(__('messages.nav_tableau_label')); ?></div>
            <?php $__currentLoopData = $tableauLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($item['href']); ?>" onclick="closeNavMenu()"
                   class="<?php echo e($item['featured'] ? 'nav-mobile-special' : ''); ?>"
                   style="<?php echo e(!$item['featured'] ? 'padding-left:32px;font-size:13px' : ''); ?>">
                    <span class="nav-mobile-icon"><?php echo e($item['featured'] ? '📋' : '›'); ?></span>
                    <?php echo e($item['label']); ?>

                    <?php if($item['featured'] && $isUser): ?><span style="font-size:11px;opacity:0.6"> 🔒</span><?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
            <?php if($hasAccess): ?>
                <div class="nav-mobile-divider"></div>
                <a href="<?php echo e(route('chantiers.index')); ?>" onclick="closeNavMenu()">
                    <span class="nav-mobile-icon">🏗️</span><?php echo e(__('messages.nav_chantiers')); ?>

                </a>
            <?php endif; ?>
            <?php if(auth()->user()->isAdmin()): ?>
                <a href="<?php echo e(route('users.index')); ?>" onclick="closeNavMenu()">
                    <span class="nav-mobile-icon">👥</span><?php echo e(__('messages.nav_manage_users')); ?>

                </a>
                <a href="<?php echo e(route('admin.tickets.index')); ?>" onclick="closeNavMenu()">
                    <span class="nav-mobile-icon">✉️</span>Messages
                </a>
                <a href="<?php echo e(route('admin.logs.index')); ?>" onclick="closeNavMenu()">
                    <span class="nav-mobile-icon">📋</span>Logs
                </a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>

    <div class="nav-mobile-footer">
        <div class="nav-mobile-divider"></div>

        
        <div class="nav-mobile-langs">
            <?php $__currentLoopData = $flagCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $iso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('lang.switch', $code)); ?>"
                   class="nav-mobile-lang <?php echo e($locale === $code ? 'nav-mobile-lang--active' : ''); ?>">
                    <span class="fi fi-<?php echo e($iso); ?>"></span>
                    <?php echo e($langLabels[$code]); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="nav-mobile-divider"></div>

        <?php if(auth()->guard()->check()): ?>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="padding:0 16px 10px">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-logout-mobile"><?php echo e(__('messages.nav_logout')); ?></button>
            </form>
        <?php endif; ?>
        <?php if(auth()->guard()->guest()): ?>
            <div style="padding:0 16px 8px">
                <a href="<?php echo e(route('tarifs')); ?>" class="btn-login-mobile" style="background:#f59e0b;margin-bottom:8px;display:block">
                    <?php echo e(__('messages.nav_buy')); ?>

                </a>
                <a href="<?php echo e(route('login')); ?>" class="btn-login-mobile">
                    <?php echo e(__('messages.nav_login')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
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
const _dropdowns = ['tableauMenu','langMenu'];
function toggleDropdown(id) {
    const isOpen = document.getElementById(id).classList.contains('open');
    closeAllDropdowns();
    if (!isOpen) {
        document.getElementById(id).classList.add('open');
        if (id === 'tableauMenu') {
            const arr = document.getElementById('tableauArrow');
            if (arr) arr.style.transform = 'rotate(180deg)';
        }
    }
}
function closeAllDropdowns() {
    _dropdowns.forEach(id => document.getElementById(id)?.classList.remove('open'));
    const arr = document.getElementById('tableauArrow');
    if (arr) arr.style.transform = '';
}
document.addEventListener('click', e => {
    if (!e.target.closest('.nav-dropdown, .lang-dropdown')) closeAllDropdowns();
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeAllDropdowns(); closeNavMenu(); }
});
</script>
<?php /**PATH C:\xampp\htdocs\planex\resources\views/partials/navbar.blade.php ENDPATH**/ ?>