@extends('layouts.app')

@section('content')

<div class="container-fluid px-3 px-md-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h3 mb-0">{{ __('messages.users_title') }}</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            {{ __('messages.user_add') }}
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger mb-3">{{ $errors->first() }}</div>
    @endif

    {{-- Barre de recherche --}}
    <div class="mb-3" style="max-width:400px">
        <div class="search-input-group">
            <span class="search-icon">🔍</span>
            <input type="text"
                   id="userSearch"
                   class="search-input"
                   placeholder="{{ __('messages.user_search_placeholder') }}"
                   autocomplete="off">
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle" id="usersTable">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('messages.col_id') }}</th>
                        <th>{{ __('messages.col_username') }}</th>
                        <th>{{ __('messages.col_email') }}</th>
                        <th>{{ __('messages.col_role') }}</th>
                        <th class="text-end">{{ __('messages.col_actions') }}</th>
                    </tr>
                </thead>
                <tbody id="usersBody">
                @forelse($users as $user)
                    <tr data-search="{{ strtolower($user->username . ' ' . ($user->email ?? '') . ' ' . $user->role) }}">
                        <td class="fw-semibold text-muted">{{ $user->id }}</td>
                        <td>
                            {{ $user->username }}
                            @if($user->id === auth()->id())
                                <span class="badge bg-secondary ms-1" style="font-size:10px">Vous</span>
                            @endif
                        </td>
                        <td>{{ $user->email ?? '—' }}</td>
                        <td>
                            @php
                                $roleColors = ['admin' => 'danger', 'incident' => 'warning', 'user' => 'secondary'];
                                $color = $roleColors[$user->role] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary">
                                    ✏️ {{ __('messages.btn_edit') }}
                                </a>
                                @if($user->must_change_password && $user->role !== 'admin')
                                <a href="{{ route('users.courrier', $user->id) }}"
                                   class="btn btn-outline-secondary"
                                   title="{{ __('messages.btn_courrier') }}">
                                    📄 PDF
                                </a>
                                @endif
                                @if($user->id !== auth()->id())
                                <form action="{{ route('users.destroy', $user->id) }}"
                                      method="POST"
                                      onsubmit="return confirmDelete('{{ addslashes($user->username) }}')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">
                                        🗑 {{ __('messages.btn_delete') }}
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">{{ __('messages.user_none') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{-- Message aucun résultat recherche --}}
            <div id="noResults" class="text-center text-muted py-4 d-none">
                {{ __('messages.user_none') }}
            </div>
        </div>
    </div>

</div>

<script>
/* ── Recherche live ── */
document.getElementById('userSearch').addEventListener('input', function () {
    const q     = this.value.toLowerCase().trim();
    const rows  = document.querySelectorAll('#usersBody tr');
    let visible = 0;

    rows.forEach(row => {
        const data = row.dataset.search ?? '';
        const show = !q || data.includes(q);
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    document.getElementById('noResults').classList.toggle('d-none', visible > 0);
});

/* ── Confirmation suppression ── */
function confirmDelete(username) {
    return confirm(
        '⚠️ Supprimer l\'utilisateur « ' + username + ' » ?\n\n' +
        'Il sera retiré de tous les chantiers et les chefs de chantier concernés seront notifiés par e-mail.'
    );
}
</script>

@endsection
