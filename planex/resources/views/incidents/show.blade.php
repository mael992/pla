@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 860px;">

    {{-- ===== EN-TÊTE ===== --}}
    <div class="mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
            <div>
                <h1 class="h4 mb-1 fw-bold">
                    {{ $incident->reference ?? 'ANO-#'.$incident->id_incident }}
                </h1>
                <span class="text-muted small">{{ __('messages.incident_issued_by') }} <strong>{{ $incident->emis_par ?? '—' }}</strong></span>
            </div>
            @php
                $badgeMap = [
                    'na'      => ['secondary', __('messages.status_na')],
                    'ouvert'  => ['danger',    __('messages.status_open')],
                    'en_cours'=> ['warning',   __('messages.status_in_progress')],
                    'fermer'  => ['success',   __('messages.status_closed')],
                ];
                $b = $badgeMap[$incident->statut] ?? ['secondary', ucfirst($incident->statut)];
            @endphp
            <span class="badge bg-{{ $b[0] }} fs-6 px-3 py-2">{{ $b[1] }}</span>
        </div>
    </div>

    {{-- ===== INFORMATIONS GÉNÉRALES ===== --}}
    <div class="card shadow-sm mb-3">
        <div class="card-header fw-semibold">{{ __('messages.section_general_info') }}</div>
        <div class="card-body p-0">
            <dl class="info-grid mb-0">
                <div class="info-row">
                    <dt>{{ __('messages.field_discipline') }}</dt>
                    <dd>{{ $incident->discipline ?? '—' }}</dd>
                </div>
                <div class="info-row">
                    <dt>{{ __('messages.field_system') }}</dt>
                    <dd>{{ $incident->systeme ?? '—' }}</dd>
                </div>
                <div class="info-row">
                    <dt>{{ __('messages.field_work_lot') }}</dt>
                    <dd>{{ $incident->lot_travail ?? '—' }}</dd>
                </div>
                <div class="info-row">
                    <dt>{{ __('messages.field_zone') }}</dt>
                    <dd>{{ $incident->zoneobj->name ?? '—' }}</dd>
                </div>
                <div class="info-row">
                    <dt>{{ __('messages.field_chantier') }}</dt>
                    <dd>
                        @if($incident->chantier)
                            <span>{{ $incident->chantier->nom }}</span>
                            <span class="text-muted small ms-1">📍 {{ $incident->chantier->localite }}</span>
                        @else
                            —
                        @endif
                    </dd>
                </div>
                <div class="info-row">
                    <dt>{{ __('messages.field_label') }}</dt>
                    <dd>{{ $incident->etiquette ?? '—' }}</dd>
                </div>
                <div class="info-row">
                    <dt>{{ __('messages.field_category') }}</dt>
                    <dd>{{ $incident->categorie_label ?? '—' }}</dd>
                </div>
                <div class="info-row">
                    <dt>{{ __('messages.field_internal') }}</dt>
                    <dd>{{ $incident->interne ?? '—' }}</dd>
                </div>
                <div class="info-row">
                    <dt>{{ __('messages.field_responsibility') }}</dt>
                    <dd>{{ $incident->responsabilite ?? '—' }}</dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- ===== SUIVI DES DATES ===== --}}
    <div class="card shadow-sm mb-3">
        <div class="card-header fw-semibold">{{ __('messages.section_tracking') }}</div>
        <div class="card-body">
            <div class="row g-3">
                @foreach([
                    __('messages.field_issued_on')       => $incident->date_emis,
                    __('messages.field_updated_on')      => $incident->date_maj,
                    __('messages.field_closed_on')       => $incident->date_cloture,
                    __('messages.field_planned_closure') => $incident->cloture_prevue,
                ] as $label => $date)
                <div class="col-6 col-sm-3">
                    <div class="date-chip">
                        <span class="date-chip-label">{{ $label }}</span>
                        <span class="date-chip-value">
                            {{ $date ? \Carbon\Carbon::parse($date)->format('d/m/Y') : '—' }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== DESCRIPTION ===== --}}
    <div class="card shadow-sm mb-3">
        <div class="card-header fw-semibold">{{ __('messages.section_description') }}</div>
        <div class="card-body">
            <p class="mb-0" style="white-space: pre-wrap; line-height: 1.6;">
                {{ $incident->description ?? '—' }}
            </p>
        </div>
    </div>

    {{-- ===== QFC ===== --}}
    <div class="card shadow-sm mb-3">
        <div class="card-header fw-semibold">{{ __('messages.section_qfc') }}</div>
        <div class="card-body p-0">
            <dl class="info-grid mb-0">
                <div class="info-row">
                    <dt>{{ __('messages.field_qfc_open') }}</dt>
                    <dd>{{ $incident->qfc_ouvert ?? '—' }}</dd>
                </div>
                <div class="info-row">
                    <dt>{{ __('messages.field_qfc_closed') }}</dt>
                    <dd>{{ $incident->qfc_ferme ?? '—' }}</dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- ===== PHOTOS ===== --}}
    @if($incident->photo_ouverte || $incident->photo_fermee)
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-semibold">{{ __('messages.section_photos') }}</div>
        <div class="card-body">
            <div class="row g-3">
                @if($incident->photo_ouverte)
                <div class="col-12 col-sm-6">
                    <p class="text-muted small fw-semibold mb-2">{{ __('messages.field_photo_open') }}</p>
                    <a href="{{ asset('storage/'.$incident->photo_ouverte) }}" target="_blank">
                        <img src="{{ asset('storage/'.$incident->photo_ouverte) }}"
                             class="img-fluid rounded border w-100"
                             style="object-fit: cover; max-height: 260px;">
                    </a>
                </div>
                @endif
                @if($incident->photo_fermee)
                <div class="col-12 col-sm-6">
                    <p class="text-muted small fw-semibold mb-2">{{ __('messages.field_photo_closed') }}</p>
                    <a href="{{ asset('storage/'.$incident->photo_fermee) }}" target="_blank">
                        <img src="{{ asset('storage/'.$incident->photo_fermee) }}"
                             class="img-fluid rounded border w-100"
                             style="object-fit: cover; max-height: 260px;">
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    {{-- ===== ACTIONS ===== --}}
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('incidents.index') }}" class="btn btn-outline-secondary">
            {{ __('messages.btn_back') }}
        </a>
        @if($incident->statut !== 'fermer')
            <a href="{{ route('incidents.edit', $incident->id_incident) }}" class="btn btn-primary">
                {{ __('messages.btn_edit') }}
            </a>
        @endif
    </div>

</div>
@endsection
