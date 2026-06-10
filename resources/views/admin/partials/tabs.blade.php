@php
    $adminTabs = [
        ['label' => 'Vue d\'ensemble', 'icon' => '📊', 'route' => 'admin.dashboard',     'active' => 'admin.dashboard'],
        ['label' => 'Utilisateurs',    'icon' => '👥', 'route' => 'users.index',          'active' => 'users.*'],
        ['label' => 'Messages',        'icon' => '✉️', 'route' => 'admin.tickets.index',  'active' => 'admin.tickets.*'],
        ['label' => 'Logs',            'icon' => '📋', 'route' => 'admin.logs.index',     'active' => 'admin.logs.*'],
    ];
@endphp

<div class="admin-tabs mb-4">
    <div class="d-flex flex-wrap gap-2">
        @foreach($adminTabs as $tab)
            @php $isActive = request()->routeIs($tab['active']); @endphp
            <a href="{{ route($tab['route']) }}"
               class="admin-tab {{ $isActive ? 'admin-tab--active' : '' }}">
                <span class="admin-tab-icon">{{ $tab['icon'] }}</span>
                <span>{{ $tab['label'] }}</span>
            </a>
        @endforeach
    </div>
</div>

<style>
.admin-tabs { border-bottom: 2px solid #e2e8f0; padding-bottom: 0; }
.admin-tab {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 16px; border-radius: 8px 8px 0 0;
    font-size: .92rem; font-weight: 600; color: #64748b;
    text-decoration: none; border: 2px solid transparent; border-bottom: none;
    margin-bottom: -2px; transition: background .15s, color .15s;
}
.admin-tab:hover { background: #f1f5f9; color: #1e293b; }
.admin-tab--active {
    color: #1e293b; background: #fff;
    border-color: #e2e8f0; border-bottom: 2px solid #fff;
}
.admin-tab-icon { font-size: 1.05rem; }
</style>
