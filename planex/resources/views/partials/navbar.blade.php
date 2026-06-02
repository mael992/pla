@php
    $locale = app()->getLocale();
    // code ISO 3166-1 alpha-2 pour flag-icons (gb pour anglais)
    $flagCodes = ['fr' => 'fr', 'en' => 'gb', 'it' => 'it', 'es' => 'es'];
    // Libellés affichés dans le bouton trigger (EN pas GB)
    $langLabels = ['fr' => 'FR', 'en' => 'EN', 'it' => 'IT', 'es' => 'ES'];
    $langNames  = ['fr' => 'Français', 'en' => 'English', 'it' => 'Italiano', 'es' => 'Español'];

    $tableauLinks = [
        ['label' => __('messages.nav_dashboard'),        'route' => 'dashboard', 'featured' => true ],
        ['label' => __('messages.nav_tab_engineering'),  'route' => null,        'featured' => false],
        ['label' => __('messages.nav_tab_development'),  'route' => null,        'featured' => false],
        ['label' => __('messages.nav_tab_precom'),       'route' => null,        'featured' => false],
        ['label' => __('messages.nav_tab_operations'),   'route' => null,        'featured' => false],
        ['label' => __('messages.nav_tab_support'),      'route' => null,        'featured' => false],
    ];
@endphp

<nav class="navbar">
    <div class="navbar-container">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/Planex.jpg') }}" alt="PlanEx">
        </a>

        {{-- LIENS CENTRE (desktop) --}}
        <ul class="nav-links-desktop">
            <li><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
            <li><a href="{{ route('infos') }}">{{ __('messages.nav_infos') }}</a></li>
            <li><a href="#">{{ __('messages.nav_news') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('messages.nav_contact') }}</a></li>

            {{-- DROPDOWN "TABLEAU ANOMALIE" — géré en JS --}}
            <li class="nav-dropdown" id="tableauDropdown">
                <button class="nav-dropdown-trigger"
                        type="button"
                        onclick="toggleDropdown('tableauMenu')"
                        aria-haspopup="true"
                        aria-expanded="false">
                    {{ __('messages.nav_tableau_label') }}
                    <span class="nav-dropdown-arrow" id="tableauArrow">▾</span>
                </button>
                <ul class="nav-dropdown-menu" id="tableauMenu">
                    @foreach($tableauLinks as $item)
                        @if($item['featured'] && !auth()->check()) @continue @endif
                        <li>
                            <a href="{{ $item['route'] ? route($item['route']) : '#' }}"
                               class="{{ $item['featured'] ? 'nav-dropdown-featured' : '' }}"
                               onclick="closeAllDropdowns()">
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>

        {{-- ZONE DROITE --}}
        <div class="nav-right">

            @auth
                <div class="nav-desktop-auth">
                    <span class="user">
                        <span class="user-dot"></span>
                        {{ auth()->user()->username }}
                    </span>
                    <div class="nav-sep"></div>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('users.index') }}" class="btn-nav-users">
                            {{ __('messages.nav_manage_users') }}
                        </a>
                        <div class="nav-sep"></div>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout">{{ __('messages.nav_logout') }}</button>
                    </form>
                    <div class="nav-sep"></div>
                </div>
            @endauth

            @guest
                <div class="nav-desktop-auth">
                    <a href="{{ route('login') }}" class="btn-login">{{ __('messages.nav_login') }}</a>
                    <div class="nav-sep"></div>
                </div>
            @endguest

            {{-- SÉLECTEUR LANGUE --}}
            <div class="lang-dropdown" id="langDropdown">
                <button class="lang-dropdown-trigger"
                        type="button"
                        onclick="toggleDropdown('langMenu')"
                        aria-haspopup="true">
                    <span class="fi fi-{{ $flagCodes[$locale] ?? 'fr' }}"></span>
                    <span class="lang-code">{{ $langLabels[$locale] ?? 'FR' }}</span>
                    <span class="lang-arrow">▾</span>
                </button>
                <ul class="nav-dropdown-menu lang-dropdown-menu" id="langMenu">
                    @foreach($flagCodes as $code => $iso)
                        <li>
                            <a href="{{ route('lang.switch', $code) }}"
                               class="{{ $locale === $code ? 'lang-option-active' : '' }}"
                               onclick="closeAllDropdowns()">
                                <span class="fi fi-{{ $iso }}"></span>
                                <span>{{ $langNames[$code] }}</span>
                                @if($locale === $code)<span class="lang-check">✓</span>@endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- HAMBURGER mobile --}}
            <button class="nav-hamburger" onclick="openNavMenu()" aria-label="Menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>

        </div>
    </div>
</nav>

{{-- DRAWER MOBILE --}}
<div class="nav-mobile-overlay" id="navMobileOverlay" onclick="closeNavMenu()"></div>
<div class="nav-mobile-menu" id="navMobileMenu" role="dialog">

    <div class="nav-mobile-header">
        <img src="{{ asset('images/Planex.jpg') }}" alt="PlanEx" style="height:34px;">
        <button onclick="closeNavMenu()" class="nav-mobile-close">✕</button>
    </div>

    @auth
        <div class="nav-mobile-user">
            <span class="user-dot"></span>
            <span class="nav-mobile-username">{{ auth()->user()->username }}</span>
            <span class="nav-mobile-role">{{ ucfirst(auth()->user()->role) }}</span>
        </div>
        <div class="nav-mobile-divider"></div>
    @endauth

    <nav class="nav-mobile-links">
        <a href="{{ route('home') }}"    onclick="closeNavMenu()"><span class="nav-mobile-icon">🏠</span>{{ __('messages.nav_home') }}</a>
        <a href="{{ route('infos') }}"   onclick="closeNavMenu()"><span class="nav-mobile-icon">ℹ️</span>{{ __('messages.nav_infos') }}</a>
        <a href="#"                      onclick="closeNavMenu()"><span class="nav-mobile-icon">🆕</span>{{ __('messages.nav_news') }}</a>
        <a href="{{ route('contact') }}" onclick="closeNavMenu()"><span class="nav-mobile-icon">✉️</span>{{ __('messages.nav_contact') }}</a>

        <div class="nav-mobile-divider"></div>
        <div class="nav-mobile-section-label">{{ __('messages.nav_tableau_label') }}</div>
        @foreach($tableauLinks as $item)
            @if($item['featured'] && !auth()->check()) @continue @endif
            <a href="{{ $item['route'] ? route($item['route']) : '#' }}"
               onclick="closeNavMenu()"
               class="{{ $item['featured'] ? 'nav-mobile-special' : '' }}"
               style="{{ !$item['featured'] ? 'padding-left:32px;font-size:13px' : '' }}">
                <span class="nav-mobile-icon">{{ $item['featured'] ? '📋' : '›' }}</span>{{ $item['label'] }}
            </a>
        @endforeach

        @auth
            @if(auth()->user()->isAdmin())
                <div class="nav-mobile-divider"></div>
                <a href="{{ route('users.index') }}" onclick="closeNavMenu()">
                    <span class="nav-mobile-icon">👥</span>{{ __('messages.nav_manage_users') }}
                </a>
            @endif
        @endauth
    </nav>

    <div class="nav-mobile-footer">
        <div class="nav-mobile-divider"></div>

        {{-- Langue en pills avec drapeaux SVG --}}
        <div class="nav-mobile-langs">
            @foreach($flagCodes as $code => $iso)
                <a href="{{ route('lang.switch', $code) }}"
                   class="nav-mobile-lang {{ $locale === $code ? 'nav-mobile-lang--active' : '' }}">
                    <span class="fi fi-{{ $iso }}"></span>
                    {{ $langLabels[$code] }}
                </a>
            @endforeach
        </div>

        @auth
            <div class="nav-mobile-divider"></div>
            <form method="POST" action="{{ route('logout') }}" style="padding:0 16px 16px">
                @csrf
                <button type="submit" class="btn-logout-mobile">{{ __('messages.nav_logout') }}</button>
            </form>
        @endauth
        @guest
            <div style="padding:0 16px 16px">
                <a href="{{ route('login') }}" class="btn-login-mobile">{{ __('messages.nav_login') }}</a>
            </div>
        @endguest
    </div>
</div>

<script>
/* ══ Drawer mobile ══ */
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

/* ══ Dropdowns click (tableau + langue) ══ */
const _dropdowns = ['tableauMenu', 'langMenu'];

function toggleDropdown(id) {
    const isOpen = document.getElementById(id).classList.contains('open');
    closeAllDropdowns();
    if (!isOpen) {
        document.getElementById(id).classList.add('open');
        // Rotation de la flèche correspondante
        const arrowId = id === 'tableauMenu' ? 'tableauArrow' : null;
        if (arrowId) document.getElementById(arrowId).style.transform = 'rotate(180deg)';
    }
}

function closeAllDropdowns() {
    _dropdowns.forEach(id => {
        document.getElementById(id)?.classList.remove('open');
    });
    const arr = document.getElementById('tableauArrow');
    if (arr) arr.style.transform = '';
}

// Clic en dehors ferme tout
document.addEventListener('click', e => {
    const inNavbar = e.target.closest('.nav-dropdown, .lang-dropdown');
    if (!inNavbar) closeAllDropdowns();
});

// Échap
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeAllDropdowns(); closeNavMenu(); }
});
</script>
