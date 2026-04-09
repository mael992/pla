<nav class="navbar">
    <div class="navbar-container">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/Planex.jpg') }}" alt="PlanEx">
        </a>

        {{-- LIENS NAVIGATION --}}
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><a href="{{ route('infos') }}">Infos</a></li>
            <li><a href="#">Nouveautés</a></li>
            <li><a href="#">Contact</a></li>
            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isIncident())
                    <li>
                        <a href="{{ route('dashboard') }}" class="nav-link-special">
                            Tableau des anomalies
                        </a>
                    </li>
                @endif
            @endauth
        </ul>

        {{-- ZONE AUTH --}}
        <div class="nav-auth">
            @auth
                {{-- Indicateur utilisateur connecté --}}
                <span class="user">
                    <span class="user-dot"></span>
                    {{ auth()->user()->username }}
                </span>

                <div class="nav-sep"></div>

                {{-- Gestion users (admin seulement) --}}
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('users.index') }}" class="btn-nav-users">
                        Gestion users
                    </a>
                    <div class="nav-sep"></div>
                @endif

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn-login">Login</a>
            @endguest
        </div>

    </div>
</nav>