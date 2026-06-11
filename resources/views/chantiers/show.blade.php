@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    {{-- ── EN-TÊTE ── --}}
    <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
        <div>
            <a href="{{ route('chantiers.index') }}" class="text-muted text-decoration-none small">
                ← {{ __('messages.chantiers_title') }}
            </a>
            <h1 class="h3 mb-0 mt-1">🏗️ {{ $chantier->nom }}</h1>
            <p class="text-muted mb-0">📍 {{ $chantier->localite }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('chantiers.index') }}" class="btn btn-outline-secondary btn-sm">
                {{ __('messages.btn_back') }}
            </a>
            @if($isChef)
            <a href="{{ route('chantiers.edit', $chantier) }}" class="btn btn-outline-primary btn-sm">
                ✏️ {{ __('messages.btn_edit') }}
            </a>
            @endif
            <a href="{{ route('dashboard') }}?chantier_id={{ $chantier->id }}" class="btn btn-primary btn-sm">
                📋 {{ __('messages.incidents_title') }}
            </a>
        </div>
    </div>

    <div class="row g-4">

        {{-- ── COLONNE GAUCHE : camembert + stats ── --}}
        <div class="col-12 col-lg-5">

            {{-- Carte KPIs --}}
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="kpi-card kpi-total">
                        <span class="kpi-value">{{ $incidents->count() }}</span>
                        <span class="kpi-label">{{ __('messages.kpi_total') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="kpi-card kpi-open">
                        <span class="kpi-value">{{ $stats['ouvert'] + $stats['en_cours'] }}</span>
                        <span class="kpi-label">{{ __('messages.kpi_open') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="kpi-card kpi-closed">
                        <span class="kpi-value">{{ $stats['fermer'] }}</span>
                        <span class="kpi-label">{{ __('messages.kpi_closed') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="kpi-card kpi-progress">
                        <span class="kpi-value">
                            @if($incidents->count() > 0)
                                {{ round($stats['fermer'] / $incidents->count() * 100) }}%
                            @else
                                —
                            @endif
                        </span>
                        <span class="kpi-label">{{ __('messages.kpi_closure_rate') }}</span>
                    </div>
                </div>
            </div>

            {{-- Camembert --}}
            @if($incidents->count() > 0)
            <div class="card shadow-sm">
                <div class="card-body p-3">
                    <h6 class="fw-semibold mb-3 text-center text-muted text-uppercase" style="font-size:11px;letter-spacing:.06em">
                        {{ __('messages.chart_by_status') }}
                    </h6>
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                    {{-- Légende custom --}}
                    <ul class="chart-legend mt-3">
                        @foreach(array_combine($chartLabels, array_map(null, $chartData, $chartColors)) as $label => [$count, $color])
                        <li class="chart-legend-item">
                            <span class="chart-legend-dot" style="background:{{ $color }}"></span>
                            <span class="chart-legend-label">{{ $label }}</span>
                            <span class="chart-legend-count">{{ $count }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @else
            <div class="card shadow-sm">
                <div class="card-body text-center py-5 text-muted">
                    <div style="font-size:3rem">📭</div>
                    <p class="mt-2 mb-0">{{ __('messages.incident_none') }}</p>
                </div>
            </div>
            @endif

        </div>

        {{-- ── COLONNE DROITE : membres + anomalies ── --}}
        <div class="col-12 col-lg-7">

            {{-- ── ENTREPRISES LIÉES AUX DISCIPLINES ── --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <span class="fw-semibold" style="font-size:13px">🏢 {{ __('messages.chantier_disciplines_title') }}</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle" style="font-size:13px">
                        <thead class="table-dark">
                            <tr>
                                <th>{{ __('messages.field_discipline') }}</th>
                                <th>{{ __('messages.chantier_discipline_name') }}</th>
                                <th class="text-end">{{ __('messages.col_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($disciplineOptions as $opt)
                            <tr>
                                <td><span class="fw-semibold">{{ $opt->label }}</span></td>
                                <td>
                                    @if(filled($opt->entreprise))
                                        {{ $opt->entreprise }}
                                    @else
                                        <span class="text-warning" style="font-size:11px">⚠️ {{ __('messages.chantier_discipline_name') }}…</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if($isChef)
                                    <form action="{{ route('chantiers.disciplines.remove', [$chantier, $opt->id]) }}" method="POST"
                                          onsubmit="return confirm('{{ $opt->label }} — {{ $opt->entreprise }} ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" type="submit">✕</button>
                                    </form>
                                    @else
                                        <span class="text-muted" style="font-size:11px">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-muted text-center py-3" style="font-size:12px">{{ __('messages.chantier_discipline_none') }}</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if($isChef)
                <div class="card-body border-top pt-3 pb-3">
                    <p class="fw-semibold mb-2" style="font-size:13px">➕ {{ __('messages.chantier_discipline_add') }}</p>
                    <form action="{{ route('chantiers.disciplines.add', $chantier) }}" method="POST">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col-12 col-sm-5">
                                <label class="form-label" style="font-size:12px">{{ __('messages.field_discipline') }}</label>
                                <select name="discipline" class="form-select form-select-sm" required>
                                    @foreach(\App\Models\Chantier::DISCIPLINES as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-5">
                                <label class="form-label" style="font-size:12px">{{ __('messages.chantier_discipline_name') }}</label>
                                <input type="text" name="entreprise" class="form-control form-control-sm" required maxlength="255">
                            </div>
                            <div class="col-12 col-sm-2">
                                <button class="btn btn-primary btn-sm w-100" type="submit">{{ __('messages.btn_add') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>

            {{-- ── MEMBRES ── --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <span class="fw-semibold" style="font-size:13px">👥 {{ __('messages.chantier_members') }}</span>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger m-3 mb-0">{{ $errors->first() }}</div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success m-3 mb-0">{{ session('success') }}</div>
                @endif

                @php
                    // Couples attribuables aux membres : uniquement ceux ayant une entreprise renseignée
                    $memberCouples = $disciplineOptions->filter(fn($o) => filled($o->entreprise))->values();
                @endphp

                {{-- Liste membres --}}
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle" style="font-size:13px">
                        <thead class="table-dark">
                            <tr>
                                <th>{{ __('messages.col_member') }}</th>
                                <th>{{ __('messages.col_role_chantier') }}</th>
                                <th class="text-end">{{ __('messages.col_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ $member->username }}</span>
                                    @if($member->pivot->is_creator)
                                        <span class="badge bg-warning ms-1" style="font-size:10px">{{ __('messages.col_creator') }}</span>
                                    @endif
                                    @if($member->email)
                                        <div class="text-muted" style="font-size:11px">{{ $member->email }}</div>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $memberCouple = $coupleLabels[$member->pivot->chantier_discipline_id] ?? null;
                                        $memberRoleLabel = $member->pivot->is_creator
                                            ? \App\Models\Chantier::ROLES['chef_chantier']
                                            : ($memberCouple->label ?? (\App\Models\Chantier::DISCIPLINES[$member->pivot->role_chantier] ?? $member->pivot->role_chantier));
                                    @endphp
                                    @if($isChef && !$member->pivot->is_creator && $memberCouples->isNotEmpty())
                                    <form action="{{ route('chantiers.users.update', [$chantier, $member]) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="d-flex gap-1 align-items-center">
                                            <select name="chantier_discipline_id" class="form-select form-select-sm" style="font-size:12px">
                                                @foreach($memberCouples as $opt)
                                                    <option value="{{ $opt->id }}" {{ $member->pivot->chantier_discipline_id == $opt->id ? 'selected' : '' }}>
                                                        {{ $opt->label }}{{ $opt->entreprise ? ' — '.$opt->entreprise : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-outline-primary btn-sm" type="submit" title="{{ __('messages.btn_save') }}">✓</button>
                                        </div>
                                    </form>
                                    @else
                                        <span class="badge bg-secondary" style="font-size:11px">{{ $memberRoleLabel }}</span>
                                        @if($memberCouple && $memberCouple->entreprise)
                                            <div class="text-muted" style="font-size:11px">{{ $memberCouple->entreprise }}</div>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if($isChef && !$member->pivot->is_creator)
                                    <form action="{{ route('chantiers.users.remove', [$chantier, $member]) }}" method="POST"
                                          onsubmit="return confirm('Retirer {{ $member->username }} ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" type="submit">✕</button>
                                    </form>
                                    @else
                                        <span class="text-muted" style="font-size:11px">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Ajouter un membre (chef seulement) --}}
                @if($isChef && $allUsers->isNotEmpty())
                <div class="card-body border-top pt-3 pb-3">
                    <p class="fw-semibold mb-2" style="font-size:13px">➕ {{ __('messages.chantier_add_member') }}</p>
                    @if($memberCouples->isEmpty())
                        <p class="text-warning mb-0" style="font-size:12px">⚠️ {{ __('messages.chantier_discipline_required_member') }}</p>
                    @else
                    <form action="{{ route('chantiers.users.add', $chantier) }}" method="POST">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col-12 col-sm-5">
                                <label class="form-label" style="font-size:12px">{{ __('messages.col_member') }}</label>
                                <select name="user_id" class="form-select form-select-sm" required>
                                    <option value="">{{ __('messages.chantier_member_search') }}</option>
                                    @foreach($allUsers as $u)
                                        <option value="{{ $u->id }}">{{ $u->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-5">
                                <label class="form-label" style="font-size:12px">{{ __('messages.chantier_role') }}</label>
                                <select name="chantier_discipline_id" class="form-select form-select-sm" required>
                                    @foreach($memberCouples as $opt)
                                        <option value="{{ $opt->id }}">{{ $opt->label }}{{ $opt->entreprise ? ' — '.$opt->entreprise : '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-2">
                                <button class="btn btn-primary btn-sm w-100" type="submit">{{ __('messages.btn_add') }}</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
                @endif
            </div>

            {{-- ── ANOMALIES ── --}}
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <span class="fw-semibold" style="font-size:13px">
                        {{ __('messages.chantier_anomalies') }}
                    </span>
                    <a href="{{ route('incidents.create') }}" class="btn btn-primary btn-sm">
                        + {{ __('messages.incident_add') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle" style="font-size:13px">
                        <thead class="table-dark">
                            <tr>
                                <th>{{ __('messages.col_id') }}</th>
                                <th>{{ __('messages.col_discipline') }}</th>
                                <th>{{ __('messages.col_issued_on') }}</th>
                                <th>{{ __('messages.col_status') }}</th>
                                <th class="text-end">{{ __('messages.col_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($incidents as $incident)
                            @php
                                $badgeMap = [
                                    'na'       => ['secondary', __('messages.status_na')],
                                    'ouvert'   => ['danger',    __('messages.status_open')],
                                    'en_cours' => ['warning',   __('messages.status_in_progress')],
                                    'fermer'   => ['success',   __('messages.status_closed')],
                                ];
                                $b = $badgeMap[$incident->statut] ?? ['secondary', $incident->statut];
                            @endphp
                            <tr>
                                <td>
                                    <span class="badge-ref">
                                        {{ $incident->reference ?? '#'.$incident->id_incident }}
                                    </span>
                                </td>
                                <td>{{ $incident->discipline ?? '—' }}</td>
                                <td class="text-muted">
                                    {{ $incident->date_emis
                                        ? \Carbon\Carbon::parse($incident->date_emis)->format('d/m/Y')
                                        : '—' }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $b[0] }}">{{ $b[1] }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('incidents.show', $incident->id_incident) }}"
                                       class="btn btn-outline-secondary btn-sm">
                                        {{ __('messages.btn_view') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    {{ __('messages.incident_none') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>{{-- /row --}}
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
@if($incidents->count() > 0)
(function () {
    const labels = @json($chartLabels);
    const data   = @json($chartData);
    const colors = @json($chartColors);

    const ctx = document.getElementById('statusChart').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data,
                backgroundColor: colors,
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '58%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const pct   = Math.round(ctx.parsed / total * 100);
                            return ` ${ctx.label} : ${ctx.parsed} (${pct}%)`;
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                duration: 700,
                easing: 'easeInOutQuart',
            }
        }
    });
})();
@endif
</script>
@endsection
