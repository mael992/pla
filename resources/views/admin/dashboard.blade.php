@extends('layouts.app')

@section('title', 'Administration — PlanEx')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <h1 class="h3 mb-4">{{ __('Administration') }}</h1>

    @include('admin.partials.tabs')

    <div class="row g-4">

        {{-- UTILISATEURS --}}
        <div class="col-12 col-md-4">
            <a href="{{ route('users.index') }}" class="admin-card">
                <div class="admin-card-icon" style="background:#dbeafe">👥</div>
                <div class="admin-card-value">{{ $usersCount }}</div>
                <div class="admin-card-label">{{ __('Utilisateurs') }}</div>
                <div class="admin-card-link">{{ __('Gérer les utilisateurs') }} →</div>
            </a>
        </div>

        {{-- MESSAGES --}}
        <div class="col-12 col-md-4">
            <a href="{{ route('admin.tickets.index') }}" class="admin-card">
                <div class="admin-card-icon" style="background:#fef3c7">✉️</div>
                <div class="admin-card-value">
                    {{ $ticketsOpen }}
                    @if($ticketsReopen > 0)
                        <span class="admin-card-badge">{{ $ticketsReopen }} {{ __('réouverture') }}</span>
                    @endif
                </div>
                <div class="admin-card-label">{{ __('Messages ouverts') }}</div>
                <div class="admin-card-link">{{ __('Voir les messages') }} →</div>
            </a>
        </div>

        {{-- LOGS --}}
        <div class="col-12 col-md-4">
            <a href="{{ route('admin.logs.index') }}" class="admin-card">
                <div class="admin-card-icon" style="background:#e0e7ff">📋</div>
                <div class="admin-card-value">{{ $logFiles }}</div>
                <div class="admin-card-label">{{ __('Fichiers de logs') }}</div>
                <div class="admin-card-link">{{ __('Consulter les logs') }} →</div>
            </a>
        </div>

    </div>
</div>

<style>
.admin-card {
    display: block; background: #fff; border: 1px solid #e2e8f0;
    border-radius: 12px; padding: 24px; text-decoration: none;
    box-shadow: 0 2px 10px rgba(0,0,0,.05);
    transition: transform .15s, box-shadow .15s;
    height: 100%;
}
.admin-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }
.admin-card-icon {
    width: 48px; height: 48px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; margin-bottom: 14px;
}
.admin-card-value {
    font-size: 2rem; font-weight: 800; color: #1e293b; line-height: 1;
    display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
}
.admin-card-badge {
    font-size: .7rem; font-weight: 700; color: #b45309;
    background: #fef3c7; border-radius: 12px; padding: 3px 10px;
}
.admin-card-label { color: #64748b; font-weight: 600; margin-top: 4px; }
.admin-card-link { color: #2563eb; font-size: .85rem; font-weight: 600; margin-top: 14px; }
</style>
@endsection
