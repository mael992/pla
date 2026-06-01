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
        
        <a href="{{ route('home') }}" class="sidebar-link">
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
    @if(auth()->user()->isAdmin())
        <div class="sidebar-divider"></div>
        <a href="{{ route('users.create') }}" class="sidebar-cta">
            <span style="font-size:16px">➕</span> Ajouter un utilisateur
        </a>
        @endif
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
                    <a href="{{ route('users.index') }}" class="sidebar-link  active">
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

@foreach($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->username }}</td>
    <td>{{ $user->role }}</td>
    <td>
        <a href="{{ route('users.edit', $user->id) }}">✏️</a>
    </td>
</tr>
@endforeach

</table>

@endsection
