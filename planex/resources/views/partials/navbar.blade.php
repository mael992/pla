<nav class="navbar">

    <div class="navbar-container">

        {{-- LOGO + TITLE --}}
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/Planex.jpg') }}" alt="PlanEx">
        </a>

        {{-- LINKS --}}
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><a href="{{ route('infos') }}">Infos</a></li>
            <li><a href="#">Nouveautés</a></li>
            <li><a href="#">Contact</a></li>

            @auth
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('dashboard') }}">📊 Tableau des anomalies</a></li>
                @endif
            @endauth
        </ul>

        {{-- AUTH --}}
        <div class="nav-auth">

            @auth
                <span class="user">👤 {{ auth()->user()->username }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn-logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-login">Login</a>
            @endauth

        </div>

    </div>

</nav>