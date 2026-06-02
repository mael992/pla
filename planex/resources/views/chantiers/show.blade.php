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
            <a href="{{ route('chantiers.edit', $chantier) }}" class="btn btn-outline-primary btn-sm">
                ✏️ {{ __('messages.btn_edit') }}
            </a>
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
                        <span class="kpi-label">Total anomalies</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="kpi-card kpi-open">
                        <span class="kpi-value">{{ $stats['ouvert'] + $stats['en_cours'] }}</span>
                        <span class="kpi-label">En cours / ouvertes</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="kpi-card kpi-closed">
                        <span class="kpi-value">{{ $stats['fermer'] }}</span>
                        <span class="kpi-label">Fermées</span>
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
                        <span class="kpi-label">Taux de clôture</span>
                    </div>
                </div>
            </div>

            {{-- Camembert --}}
            @if($incidents->count() > 0)
            <div class="card shadow-sm">
                <div class="card-body p-3">
                    <h6 class="fw-semibold mb-3 text-center text-muted text-uppercase" style="font-size:11px;letter-spacing:.06em">
                        Répartition par statut
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
                    <p class="mt-2 mb-0">Aucune anomalie pour ce chantier.</p>
                </div>
            </div>
            @endif

        </div>

        {{-- ── COLONNE DROITE : liste des anomalies ── --}}
        <div class="col-12 col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center py-2">
                    <span class="fw-semibold" style="font-size:13px">
                        Anomalies du chantier
                    </span>
                    <a href="{{ route('incidents.create') }}" class="btn btn-primary btn-sm">
                        + {{ __('messages.incident_add') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle" style="font-size:13px">
                        <thead class="table-dark">
                            <tr>
                                <th>Réf.</th>
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
