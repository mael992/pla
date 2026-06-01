<nav class="navbar">
    <div class="navbar-container">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/Planex.jpg') }}" alt="PlanEx">
        </a>

        {{-- ZONE AUTH --}}
        <div class="nav-auth">

            @auth
                <div class="nav-sep"></div>

                <span class="user">
                    <span class="user-dot"></span>
                    {{ auth()->user()->username }}
                </span>

                <div class="nav-sep"></div>

                

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Déconnexion</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn-login">Connexion</a>
            @endguest

        </div>
    </div>
</nav>

{{-- MENU MOBILE (drawer) — remplace les liens navbar sur petit écran --}}
<div class="nav-mobile-overlay" id="navMobileOverlay"
     onclick="closeNavMenu()"></div>

<div class="nav-mobile-menu" id="navMobileMenu">

    <div class="nav-mobile-header">
        <img src="{{ asset('images/Planex.jpg') }}" alt="PlanEx" style="height:36px;">
        <button onclick="closeNavMenu()" class="nav-mobile-close">✕</button>
    </div>

    <nav class="nav-mobile-links">
        <a href="{{ route('home') }}">Accueil</a>
        <a href="{{ route('infos') }}">Infos</a>
        <a href="#">Nouveautés</a>
        <a href="#">Contact</a>

        @auth
            @if(auth()->user()->isAdmin() || auth()->user()->isIncident())
                <a href="{{ route('dashboard') }}" class="nav-mobile-special">
                    Tableau des anomalies
                </a>
            @endif
            @if(auth()->user()->isAdmin())
                <a href="{{ route('users.index') }}">Gestion users</a>
            @endif
        @endauth
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
