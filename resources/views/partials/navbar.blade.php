@php
    $locale = app()->getLocale();
    $flagCodes  = ['fr' => 'fr', 'en' => 'gb', 'it' => 'it', 'es' => 'es'];
    $langLabels = ['fr' => 'FR', 'en' => 'EN', 'it' => 'IT', 'es' => 'ES'];
    $langNames  = ['fr' => 'Français', 'en' => 'English', 'it' => 'Italiano', 'es' => 'Español'];

    $hasAccess  = auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isIncident());
    $isLoggedIn = auth()->check();
    $isUser     = $isLoggedIn && auth()->user()->role === 'user';

    // Badge "nouveauté" : change cet identifiant a chaque nouvelle annonce
    // pour reafficher la pastille a tous les visiteurs.
    $newsVersion = '2026-06-tableau-anomalies';
    $onNewsPage  = request()->routeIs('nouveautes');

    // Lien tableau : dashboard si accès, tarifs sinon
    $tableauHref = $hasAccess ? route('dashboard') : route('tarifs');

    $tabHref = $hasAccess ? route('dashboard') : route('tarifs');

    $tableauLinks = [
        ['label' => __('messages.nav_dashboard'),        'href' => $tableauHref, 'featured' => true ],
        ['label' => __('messages.nav_tab_engineering'),  'href' => $tabHref,     'featured' => false],
        ['label' => __('messages.nav_tab_development'),  'href' => $tabHref,     'featured' => false],
        ['label' => __('messages.nav_tab_precom'),       'href' => $tabHref,     'featured' => false],
        ['label' => __('messages.nav_tab_operations'),   'href' => $tabHref,     'featured' => false],
        ['label' => __('messages.nav_tab_support'),      'href' => $tabHref,     'featured' => false],
    ];
@endphp

<style>
.nav-news-link { position: relative; }
.nav-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 18px;
    height: 18px;
    padding: 0 5px;
    margin-left: 6px;
    border-radius: 9px;
    background: #ef4444;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    line-height: 1;
    vertical-align: middle;
    box-shadow: 0 0 0 2px rgba(239,68,68,.25);
}

/* ── Bouton "Mon compte" (nom d'utilisateur) ─────────────── */
.nav-account {
    position: relative;
    color: #ddd !important;
    text-decoration: none;
    padding: 5px 11px;
    border-radius: 999px;
    border: 1px solid transparent;
    transition: background .15s ease, color .15s ease, border-color .15s ease;
}
.nav-account:hover {
    background: rgba(255,255,255,.08);
    border-color: rgba(255,255,255,.18);
    color: #fff !important;
}
.nav-account .nav-account-gear {
    font-size: 11px;
    opacity: .6;
    transition: opacity .15s ease, transform .3s ease;
}
.nav-account:hover .nav-account-gear { opacity: 1; transform: rotate(90deg); }
/* Bulle d'info au survol */
.nav-account-tip {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%) translateY(2px);
    background: #111;
    color: #fff;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
    padding: 5px 10px;
    border-radius: 6px;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    z-index: 2000;
    box-shadow: 0 6px 18px rgba(0,0,0,.35);
    transition: opacity .15s ease, transform .15s ease;
}
.nav-account-tip::before {
    content: '';
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-bottom-color: #111;
}
.nav-account:hover .nav-account-tip {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%) translateY(8px);
}
</style>

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
            <li><a href="{{ route('nouveautes') }}" class="nav-news-link">{{ __('messages.nav_news') }}<span class="nav-badge" data-news-badge style="display:none">1</span></a></li>
            <li><a href="{{ route('contact') }}">{{ __('messages.nav_contact') }}</a></li>

            {{-- Dropdown tableau — visible uniquement si connecté --}}
            @if($isLoggedIn)
            <li class="nav-dropdown" id="tableauDropdown">
                <button class="nav-dropdown-trigger" type="button"
                        onclick="toggleDropdown('tableauMenu')" aria-haspopup="true">
                    {{ __('messages.nav_tableau_label') }}
                    <span class="nav-dropdown-arrow" id="tableauArrow">▾</span>
                </button>
                <ul class="nav-dropdown-menu" id="tableauMenu">
                    @foreach($tableauLinks as $item)
                        <li>
                            <a href="{{ $item['href'] }}"
                               class="{{ $item['featured'] ? 'nav-dropdown-featured' : '' }}"
                               onclick="closeAllDropdowns()">
                                {{ $item['label'] }}
                                @if($item['featured'] && $isUser)
                                    <span style="font-size:10px;margin-left:4px;opacity:0.7">🔒</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            @endif
        </ul>

        {{-- ZONE DROITE --}}
        <div class="nav-right">

            @auth
                <div class="nav-desktop-auth">
                    <a href="{{ route('profile.edit') }}" class="user nav-account">
                        <span class="user-dot"></span>
                        {{ auth()->user()->username }}
                        <span class="nav-account-gear">⚙</span>
                        <span class="nav-account-tip">{{ __('messages.account_manage_hint') }}</span>
                    </a>
                    <div class="nav-sep"></div>
                    @if($hasAccess)
                        <a href="{{ route('chantiers.index') }}" class="btn-nav-users">
                            {{ __('messages.nav_chantiers') }}
                        </a>
                        <div class="nav-sep"></div>
                    @endif
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-nav-users">
                            {{ __('Administration') }}
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
                    {{-- Bouton Acheter pour les visiteurs --}}
                    <a href="{{ route('tarifs') }}" class="btn-buy">
                        {{ __('messages.nav_buy') }}
                    </a>
                    <div class="nav-sep"></div>
                    <a href="{{ route('login') }}" class="btn-login">{{ __('messages.nav_login') }}</a>
                    <div class="nav-sep"></div>
                </div>
            @endguest

            {{-- LANGUE --}}
            <div class="lang-dropdown" id="langDropdown">
                <button class="lang-dropdown-trigger" type="button"
                        onclick="toggleDropdown('langMenu')">
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

            {{-- HAMBURGER --}}
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
        <a href="{{ route('nouveautes') }}" onclick="closeNavMenu()"><span class="nav-mobile-icon">🆕</span>{{ __('messages.nav_news') }}<span class="nav-badge" data-news-badge style="display:none">1</span></a>
        <a href="{{ route('contact') }}" onclick="closeNavMenu()"><span class="nav-mobile-icon">✉️</span>{{ __('messages.nav_contact') }}</a>

        {{-- Tableau anomalie — uniquement si connecté --}}
        @if($isLoggedIn)
            <div class="nav-mobile-divider"></div>
            <div class="nav-mobile-section-label">{{ __('messages.nav_tableau_label') }}</div>
            @foreach($tableauLinks as $item)
                <a href="{{ $item['href'] }}" onclick="closeNavMenu()"
                   class="{{ $item['featured'] ? 'nav-mobile-special' : '' }}"
                   style="{{ !$item['featured'] ? 'padding-left:32px;font-size:13px' : '' }}">
                    <span class="nav-mobile-icon">{{ $item['featured'] ? '📋' : '›' }}</span>
                    {{ $item['label'] }}
                    @if($item['featured'] && $isUser)<span style="font-size:11px;opacity:0.6"> 🔒</span>@endif
                </a>
            @endforeach
        @endif

        @auth
            <div class="nav-mobile-divider"></div>
            <a href="{{ route('profile.edit') }}" onclick="closeNavMenu()">
                <span class="nav-mobile-icon">👤</span>{{ __('messages.account_link') }}
            </a>
            @if($hasAccess)
                <a href="{{ route('chantiers.index') }}" onclick="closeNavMenu()">
                    <span class="nav-mobile-icon">🏗️</span>{{ __('messages.nav_chantiers') }}
                </a>
            @endif
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" onclick="closeNavMenu()">
                    <span class="nav-mobile-icon">🛠️</span>{{ __('Administration') }}
                </a>
            @endif
        @endauth
    </nav>

    <div class="nav-mobile-footer">
        <div class="nav-mobile-divider"></div>

        {{-- Langue --}}
        <div class="nav-mobile-langs">
            @foreach($flagCodes as $code => $iso)
                <a href="{{ route('lang.switch', $code) }}"
                   class="nav-mobile-lang {{ $locale === $code ? 'nav-mobile-lang--active' : '' }}">
                    <span class="fi fi-{{ $iso }}"></span>
                    {{ $langLabels[$code] }}
                </a>
            @endforeach
        </div>

        <div class="nav-mobile-divider"></div>

        @auth
            <form method="POST" action="{{ route('logout') }}" style="padding:0 16px 10px">
                @csrf
                <button type="submit" class="btn-logout-mobile">{{ __('messages.nav_logout') }}</button>
            </form>
        @endauth
        @guest
            <div style="padding:0 16px 8px">
                <a href="{{ route('tarifs') }}" class="btn-login-mobile" style="background:#f59e0b;margin-bottom:8px;display:block">
                    {{ __('messages.nav_buy') }}
                </a>
                <a href="{{ route('login') }}" class="btn-login-mobile">
                    {{ __('messages.nav_login') }}
                </a>
            </div>
        @endguest
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

// ── Pastille "nouveauté" sur le menu Nouveautés ──────────────
(function () {
    const NEWS_VERSION = @json($newsVersion);
    const ON_NEWS_PAGE = @json($onNewsPage);
    const KEY = 'planex_news_seen';
    const badges = document.querySelectorAll('[data-news-badge]');

    if (ON_NEWS_PAGE) {
        // L'utilisateur consulte la page : on marque comme vu, pas de pastille
        try { localStorage.setItem(KEY, NEWS_VERSION); } catch (e) {}
        return;
    }

    let seen = null;
    try { seen = localStorage.getItem(KEY); } catch (e) {}
    if (seen !== NEWS_VERSION) {
        badges.forEach(b => { b.style.display = 'inline-flex'; });
    }
})();
</script>
