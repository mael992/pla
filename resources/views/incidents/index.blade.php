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
        <a href="{{ route('incidents.index') }}" class="sidebar-link active">
            <span class="sidebar-icon" style="font-size:16px">📋</span> {{ __('messages.sidebar_incidents') }}
        </a>
        <a href="{{ route('incidents.create') }}" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">➕</span> {{ __('messages.sidebar_new_incident') }}
        </a>
        <a href="{{ route('zones.index') }}" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">📍</span> {{ __('messages.sidebar_manage_zones') }}
        </a>
        <a href="{{ route('chantiers.index') }}" class="sidebar-link">
            <span class="sidebar-icon" style="font-size:16px">🏗️</span> {{ __('messages.nav_chantiers') }}
        </a>
        <div class="sidebar-divider"></div>
        <a href="{{ route('incidents.create') }}" class="sidebar-cta">
            <span style="font-size:16px">💬</span> {{ __('messages.sidebar_add_incident') }}
        </a>
        <div class="sidebar-divider"></div>
        {{-- Bouton export PDF — passe les filtres actifs --}}
        <a href="{{ route('incidents.pdf', array_filter([
                'chantier_id' => request('chantier_id'),
                'search'      => request('search'),
           ])) }}"
           class="sidebar-pdf-btn" target="_blank">
            {{ __('messages.pdf_download') }}
            @if($activeChantier)
                <span class="sidebar-pdf-filter">{{ $activeChantier->nom }}</span>
            @elseif($activeSearch)
                <span class="sidebar-pdf-filter">« {{ Str::limit($activeSearch, 14) }} »</span>
            @endif
        </a>

        {{-- Bouton Guide — ouvre la page dédiée --}}
        <a href="{{ route('guide') }}" class="sidebar-guide-btn"
           style="display:flex;align-items:center;gap:10px;margin:0 20px 14px;padding:11px 16px;
                  background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.2);
                  color:#cccccc;font-size:14px;font-weight:600;border-radius:8px;text-decoration:none;
                  transition:background .15s,color .15s;"
           onmouseover="this.style.background='rgba(255,255,255,0.14)';this.style.color='#fff';"
           onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='#cccccc';">
            <span style="font-size:16px">❓</span> {{ __('messages.guide_btn') }}
        </a>
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
    </div>
</div>

<div class="container-fluid px-3 px-md-4 py-4">

    <button class="sidebar-toggle" onclick="openSidebar()">☰</button>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    {{-- ── EN-TÊTE ── --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h3 mb-0">{{ __('messages.incidents_title') }}</h1>
        <a href="{{ route('incidents.create') }}" class="btn btn-primary">
            {{ __('messages.incident_add') }}
        </a>
    </div>

    {{-- ── BARRE DE RECHERCHE ── --}}
    <div class="search-bar-wrapper mb-3">
        <form method="GET" action="{{ route('dashboard') }}" id="searchForm" autocomplete="off">

            <div class="search-input-group" id="searchGroup">
                <span class="search-icon">🔍</span>
                <input
                    type="text"
                    id="searchInput"
                    name="search"
                    class="search-input"
                    placeholder="{{ __('messages.search_placeholder') }}"
                    value="{{ $activeSearch }}"
                    autocomplete="off"
                >
                {{-- Champ caché pour filtrage par ID exact --}}
                <input type="hidden" id="searchChantierIdInput" name="chantier_id"
                       value="{{ request('chantier_id') }}">

                {{-- Bouton reset visible uniquement si filtre actif --}}
                @if($activeSearch || request('chantier_id'))
                    <a href="{{ route('dashboard') }}" class="search-clear" title="{{ __('messages.search_clear') }}">✕</a>
                @endif
            </div>

            {{-- Dropdown suggestions --}}
            <ul class="search-suggestions" id="searchSuggestions"></ul>
        </form>

        {{-- Badge filtre actif --}}
        @if($activeChantier)
            <div class="search-active-filter mt-2">
                <span class="search-filter-label">{{ __('messages.search_active') }}</span>
                <span class="search-filter-badge">
                    🏗️ {{ $activeChantier->nom }}
                    <span class="text-muted">— {{ $activeChantier->localite }}</span>
                </span>
                <a href="{{ route('dashboard') }}" class="search-filter-remove">✕</a>
            </div>
        @elseif($activeSearch)
            <div class="search-active-filter mt-2">
                <span class="search-filter-label">{{ __('messages.search_active') }}</span>
                <span class="search-filter-badge">« {{ $activeSearch }} »</span>
                <a href="{{ route('dashboard') }}" class="search-filter-remove">✕</a>
            </div>
        @endif
    </div>

    {{-- ── RÉSULTATS ── --}}
    @if(($activeSearch || request('chantier_id')) && $incidents->isEmpty())
        <div class="alert alert-warning">
            Aucune anomalie trouvée pour ce filtre.
            <a href="{{ route('dashboard') }}" class="alert-link ms-2">Afficher tout</a>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover table-sm-mobile mb-0 align-middle" id="incidentsTable">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('messages.col_id') }}</th>
                        <th>{{ __('messages.col_issued_on') }}</th>
                        <th>{{ __('messages.col_photo_open') }}</th>
                        <th>{{ __('messages.col_photo_closed') }}</th>
                        <th>{{ __('messages.col_closed_on') }}</th>
                        <th>{{ __('messages.col_discipline') }}</th>
                        <th>{{ __('messages.col_status') }}</th>
                        <th class="text-end">{{ __('messages.col_actions') }}</th>
                    </tr>
                </thead>
                <tbody id="incidentsBody">
                @forelse($incidents as $incident)
                    <tr data-id="{{ $incident->id_incident }}">

                        <td>
                            <span class="badge-ref">{{ $incident->reference ?? '#'.$incident->id_incident }}</span>
                        </td>

                        <td>
                            {{ $incident->date_emis
                                ? \Carbon\Carbon::parse($incident->date_emis)->format('d/m/Y')
                                : '—' }}
                        </td>

                        <td>
                            @if($incident->photo_ouverte)
                                <a href="{{ asset('storage/'.$incident->photo_ouverte) }}"
                                   target="_blank">
                                    <img src="{{ asset('storage/'.$incident->photo_ouverte) }}"
                                         class="photo-thumb">
                                </a>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>

                        <td>
                            @if($incident->photo_fermee)
                                <a href="{{ asset('storage/'.$incident->photo_fermee) }}"
                                   target="_blank">
                                    <img src="{{ asset('storage/'.$incident->photo_fermee) }}"
                                         class="photo-thumb">
                                </a>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>

                        <td>
                            {{ $incident->date_cloture
                                ? \Carbon\Carbon::parse($incident->date_cloture)->format('d/m/Y')
                                : '—' }}
                        </td>

                        <td>{{ $incident->discipline ?? '—' }}</td>

                        <td>
                            @php
                                $badgeMap = [
                                    'na'       => ['secondary', __('messages.status_na')],
                                    'ouvert'   => ['danger',    __('messages.status_open')],
                                    'en_cours' => ['warning',   __('messages.status_in_progress')],
                                    'fermer'   => ['success',   __('messages.status_closed')],
                                ];
                                $b = $badgeMap[$incident->statut]
                                    ?? ['secondary', ucfirst($incident->statut)];
                            @endphp
                            <span class="badge bg-{{ $b[0] }}">{{ $b[1] }}</span>
                        </td>

                        <td class="text-end">
                            <div class="btn-group btn-group-sm actions-btn-group">
                                <a href="{{ route('incidents.show', $incident->id_incident) }}"
                                   class="btn btn-outline-secondary">{{ __('messages.btn_view') }}</a>
                                @if($incident->statut !== 'fermer')
                                    <a href="{{ route('incidents.edit', $incident->id_incident) }}"
                                       class="btn btn-outline-primary">{{ __('messages.btn_edit') }}</a>
                                @endif
                                <form action="{{ route('incidents.destroy', $incident->id_incident) }}"
                                      method="POST"
                                      onsubmit="return confirm('{{ __('messages.incident_confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">
                                        {{ __('messages.btn_delete') }}
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr id="emptyRow">
                        <td colspan="8" class="text-center text-muted py-5">
                            {{ __('messages.incident_none') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
const POLL_URL   = '{{ route("incidents.poll") }}';
const POLL_DELAY = 5000;

let lastKnownId = {{ $incidents->isNotEmpty() ? $incidents->first()->id_incident : 0 }};

async function pollIncidents() {
    try {
        const res  = await fetch(`${POLL_URL}?last_id=${lastKnownId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        const data = await res.json();

        if (data.nouveaux && data.nouveaux.length > 0) {
            lastKnownId = data.last_id;
            insertRows(data.nouveaux);
        }

        setLiveStatus(true);
    } catch (e) {
        setLiveStatus(false);
    }

    setTimeout(pollIncidents, POLL_DELAY);
}

function insertRows(nouveaux) {
    const tbody    = document.getElementById('incidentsBody');
    const emptyRow = document.getElementById('emptyRow');
    if (emptyRow) emptyRow.remove();

    [...nouveaux].reverse().forEach(inc => {
        if (tbody.querySelector(`tr[data-id="${inc.id}"]`)) return;
        const tr = buildRow(inc);
        tbody.insertBefore(tr, tbody.firstChild);
        tr.classList.add('row-new');
        setTimeout(() => tr.classList.remove('row-new'), 3000);
    });
}

function buildRow(inc) {
    const badgeMap = {
        'na':       ['secondary', '{{ __('messages.status_na') }}'],
        'ouvert':   ['danger',    '{{ __('messages.status_open') }}'],
        'en_cours': ['warning',   '{{ __('messages.status_in_progress') }}'],
        'fermer':   ['success',   '{{ __('messages.status_closed') }}'],
    };
    const [color, label] = badgeMap[inc.statut] ?? ['secondary', inc.statut];
    const isClosed  = inc.statut === 'fermer';
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const photoOuv = inc.photo_ouverte
        ? `<a href="/storage/${inc.photo_ouverte}" target="_blank">
               <img src="/storage/${inc.photo_ouverte}" class="photo-thumb">
           </a>`
        : '<span class="text-muted small">—</span>';

    const photoFerm = inc.photo_fermee
        ? `<a href="/storage/${inc.photo_fermee}" target="_blank">
               <img src="/storage/${inc.photo_fermee}" class="photo-thumb">
           </a>`
        : '<span class="text-muted small">—</span>';

    const tr = document.createElement('tr');
    tr.dataset.id = inc.id;
    const ref = inc.reference ?? ('#' + inc.id);
    tr.innerHTML = `
        <td><span class="badge-ref">${ref}</span></td>
        <td>${inc.date_emis ?? '—'}</td>
        <td>${photoOuv}</td>
        <td>${photoFerm}</td>
        <td>${inc.date_cloture ?? '—'}</td>
        <td>${inc.discipline ?? '—'}</td>
        <td><span class="badge bg-${color}">${label}</span></td>
        <td class="text-end">
            <div class="btn-group btn-group-sm actions-btn-group">
                <a href="${inc.url_voir}" class="btn btn-outline-secondary">{{ __('messages.btn_view') }}</a>
                ${!isClosed
                    ? `<a href="${inc.url_edit}" class="btn btn-outline-primary">{{ __('messages.btn_edit') }}</a>`
                    : ''}
                <form action="${inc.url_delete}" method="POST"
                      onsubmit="return confirm('{{ __('messages.incident_confirm_delete') }}')"
                      style="display:inline">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-outline-danger" type="submit">{{ __('messages.btn_delete') }}</button>
                </form>
            </div>
        </td>`;
    return tr;
}

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

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(pollIncidents, POLL_DELAY);
});
</script>

{{-- ── AUTOCOMPLETE SEARCH ── --}}
<script>
(function () {
    const input       = document.getElementById('searchInput');
    const hiddenId    = document.getElementById('searchChantierIdInput');
    const dropdown    = document.getElementById('searchSuggestions');
    const form        = document.getElementById('searchForm');
    const SUGGEST_URL = '{{ route("incidents.suggestions") }}';

    let debounceTimer = null;
    let activeIndex   = -1;

    if (!input) return;

    // ── Frappe ──────────────────────────────────────────────
    input.addEventListener('input', () => {
        hiddenId.value = '';          // reset sélection exacte
        clearTimeout(debounceTimer);
        const q = input.value.trim();

        if (q.length < 1) { closeDropdown(); return; }

        debounceTimer = setTimeout(() => fetchSuggestions(q), 220);
    });

    // ── Navigation clavier ──────────────────────────────────
    input.addEventListener('keydown', (e) => {
        const items = dropdown.querySelectorAll('.search-suggestion-item');

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            activeIndex = Math.min(activeIndex + 1, items.length - 1);
            highlight(items);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            activeIndex = Math.max(activeIndex - 1, -1);
            highlight(items);
        } else if (e.key === 'Enter') {
            if (activeIndex >= 0 && items[activeIndex]) {
                e.preventDefault();
                items[activeIndex].click();
            }
        } else if (e.key === 'Escape') {
            closeDropdown();
        }
    });

    // ── Clic en dehors ──────────────────────────────────────
    document.addEventListener('click', (e) => {
        if (!form.contains(e.target)) closeDropdown();
    });

    // ── Fetch + rendu suggestions ───────────────────────────
    async function fetchSuggestions(q) {
        try {
            const res  = await fetch(`${SUGGEST_URL}?q=${encodeURIComponent(q)}`);
            const data = await res.json();
            renderSuggestions(data, q);
        } catch {
            closeDropdown();
        }
    }

    function renderSuggestions(chantiers, q) {
        activeIndex = -1;
        dropdown.innerHTML = '';

        if (!chantiers.length) {
            dropdown.innerHTML = '<li class="search-suggestion-empty">Aucun résultat</li>';
            openDropdown();
            return;
        }

        chantiers.forEach(c => {
            const li = document.createElement('li');
            li.className = 'search-suggestion-item';
            li.innerHTML = `
                <span class="suggestion-icon">🏗️</span>
                <span class="suggestion-content">
                    <strong>${highlight_text(c.nom, q)}</strong>
                    <small>📍 ${highlight_text(c.localite, q)}</small>
                </span>`;

            li.addEventListener('mousedown', (e) => {
                e.preventDefault();
                selectChantier(c);
            });
            dropdown.appendChild(li);
        });

        openDropdown();
    }

    function selectChantier(c) {
        input.value    = c.nom + ' — ' + c.localite;
        hiddenId.value = c.id;
        closeDropdown();
        form.submit();
    }

    function highlight(items) {
        items.forEach((item, i) => {
            item.classList.toggle('active', i === activeIndex);
        });
        if (activeIndex >= 0 && items[activeIndex]) {
            items[activeIndex].scrollIntoView({ block: 'nearest' });
        }
    }

    function highlight_text(text, q) {
        if (!q) return text;
        const re = new RegExp(`(${q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return text.replace(re, '<mark>$1</mark>');
    }

    function openDropdown()  { dropdown.classList.add('open'); }
    function closeDropdown() { dropdown.classList.remove('open'); activeIndex = -1; }

    // Si la page charge avec un filtre texte, pas de chantier_id → pas d'id caché
    @if(!request('chantier_id'))
    hiddenId.value = '';
    @endif
})();
</script>

@endsection
