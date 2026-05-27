@extends('layouts.app')

@section('content')

{{-- SIDEBAR --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
<div class="sidebar" id="sidebar">
    <button class="sidebar-close" onclick="closeSidebar()">✕</button>
    <div class="sidebar-logo">
        <img src="{{ asset('images/Planex.jpg') }}" alt="PlanEx">
    </div>
    <div class="sidebar-divider"></div>
    <nav class="sidebar-nav">
        
        <a href="{{ route('home') }}" class="sidebar-link active">
            <span class="sidebar-icon" style="font-size:16px">🏠️</span> Accueil
        </a>
        <a href="{{ route('infos') }}" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">ℹ️</span> Infos
        </a>
        <a href="{{ route('contact') }}" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">📞</span> Contact
        </a>
        @auth
        @if(auth()->user()->isAdmin() || auth()->user()->isIncident())
        <a href="{{ route('incidents.index') }}" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">📋</span> Incidents
        </a>
        @endif
    </nav>
    
    <div class="sidebar-divider"></div>
    <div class="sidebar-footer">
        <div class="sidebar-footer-item">
            <span style="font-size:16px">👤</span>
            <span>{{ auth()->user()->username ?? '—' }}</span>
        </div>
        <div class="sidebar-footer-item">
            <span style="font-size:16px">🔰</span>
            <span>{{ ucfirst(auth()->user()->role ?? 'user') }}</span>
        </div>
          
        @if(auth()->user()->isAdmin())
        <div class="sidebar-divider"></div>
                    <a href="{{ route('users.index') }}" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">🛠️</span> Gérer les comptes d'utilisateur
        </a>
                @endif
    </div>
    @endauth
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

@endsection

