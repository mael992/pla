@isset($incident)
    @method('PUT')
@endisset

@php
    $disciplines = [
        'VRD', 'Génie civil', 'Structure métallique', 'Structure bâtiment',
        'Équipement', 'Tuyauterie', 'Calorifuge',
        'Électricité', 'Instrumentation', 'Automatisme',
    ];

    $categories = [
        'A' => 'A — Avant Pre-commissioning',
        'B' => 'B — Avant la Mechanical Completion',
        'C' => 'C — Après la Mechanical Completion',
        'D' => 'D — Après la Mise en route',
    ];

    $statuts = [
        'na'      => '⬛ N/A',
        'ouvert'  => '🟥 Ouvert',
        'en_cours'=> '🟧 En cours',
        'fermer'  => '🟩 Fermé',
    ];

    $isFerme = isset($incident) && $incident->statut === 'fermer';
    $ro = $isFerme ? 'readonly' : '';          // attribut HTML readonly
    $dis = $isFerme ? 'disabled' : '';         // attribut HTML disabled
@endphp

@if($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($isFerme)
    <div class="alert alert-warning mb-4">
        Incident <strong>fermé</strong> — seul le statut peut être modifié.
    </div>
@endif

<div class="row g-3">

    {{-- DISCIPLINE --}}
    <div class="col-md-6">
        <label class="form-label">Discipline <span class="text-danger">*</span></label>
        <select name="discipline"
                class="form-select @error('discipline') is-invalid @enderror"
                {{ $dis }}>
            <option value="">— Sélectionner —</option>
            @foreach($disciplines as $d)
                <option value="{{ $d }}"
                    {{ old('discipline', $incident->discipline ?? '') === $d ? 'selected' : '' }}>
                    {{ $d }}
                </option>
            @endforeach
        </select>
        @error('discipline') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- SYSTÈME --}}
    <div class="col-md-6">
        <label class="form-label">Système <span class="text-danger">*</span></label>
        <input type="text" name="systeme"
               class="form-control @error('systeme') is-invalid @enderror"
               value="{{ old('systeme', $incident->systeme ?? '') }}"
               {{ $ro }}>
        @error('systeme') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- LOT DE TRAVAIL --}}
    <div class="col-md-6">
        <label class="form-label">Lot de travail <span class="text-danger">*</span></label>
        <input type="text" name="lot_travail"
               class="form-control @error('lot_travail') is-invalid @enderror"
               value="{{ old('lot_travail', $incident->lot_travail ?? '') }}"
               {{ $ro }}>
        @error('lot_travail') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- ZONE --}}
    <div class="col-md-6">
        <label class="form-label">Zone <span class="text-danger">*</span></label>
        <select name="zone_id"
                class="form-select @error('zone_id') is-invalid @enderror"
                {{ $dis }}>
            <option value="">— Sélectionner —</option>
            @foreach($zones as $zone)
                <option value="{{ $zone->id }}"
                    {{ old('zone_id', $incident->zone_id ?? '') == $zone->id ? 'selected' : '' }}>
                    {{ $zone->name }}
                </option>
            @endforeach
        </select>
        @error('zone_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <div class="form-text">
            <a href="{{ route('zones.index') }}" target="_blank">Gérer les zones</a>
        </div>
    </div>

    {{-- ÉTIQUETTE --}}
    <div class="col-md-6">
        <label class="form-label">Étiquette</label>
        <input type="text" name="etiquette" class="form-control"
               value="{{ old('etiquette', $incident->etiquette ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- CATÉGORIE --}}
    <div class="col-md-6">
        <label class="form-label">Catégorie <span class="text-danger">*</span></label>
        <select name="categorie"
                class="form-select @error('categorie') is-invalid @enderror"
                {{ $dis }}>
            <option value="">— Sélectionner —</option>
            @foreach($categories as $val => $label)
                <option value="{{ $val }}"
                    {{ old('categorie', $incident->categorie ?? '') === $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('categorie') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- INTERNE --}}
    <div class="col-md-6">
        <label class="form-label">Interne</label>
        <input type="text" name="interne" class="form-control"
               value="{{ old('interne', $incident->interne ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- RESPONSABILITÉ --}}
    <div class="col-md-6">
        <label class="form-label">Responsabilité</label>
        <input type="text" name="responsabilite" class="form-control"
               value="{{ old('responsabilite', $incident->responsabilite ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- STATUT --}}
    <div class="col-md-6">
        <label class="form-label">Statut <span class="text-danger">*</span></label>
        <select name="statut"
                class="form-select @error('statut') is-invalid @enderror"
                id="selectStatut"
                onchange="handleStatutChange(this.value)">
            @foreach($statuts as $val => $label)
                <option value="{{ $val }}"
                    {{ old('statut', $incident->statut ?? 'ouvert') === $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- CLÔTURE PRÉVUE --}}
    <div class="col-md-6">
        <label class="form-label">Clôture prévue</label>
        <input type="date" name="cloture_prevue" class="form-control"
               id="cloturePrevue"
               value="{{ old('cloture_prevue', isset($incident->cloture_prevue) ? \Carbon\Carbon::parse($incident->cloture_prevue)->format('Y-m-d') : '') }}"
               {{ $ro }}>
    </div>

    {{-- DATE CLÔTURE (auto si fermé, readonly) --}}
    <div class="col-md-6" id="rowDateCloture"
         style="{{ (!$isFerme && old('statut', $incident->statut ?? '') !== 'fermer') ? 'display:none' : '' }}">
        <label class="form-label">Date de clôture</label>
        <input type="text" class="form-control bg-light"
               value="{{ isset($incident->date_cloture) ? \Carbon\Carbon::parse($incident->date_cloture)->format('d/m/Y') : now()->format('d/m/Y') }}"
               readonly>
        {{-- Champ caché transmis au contrôleur --}}
        <input type="hidden" name="date_cloture"
               value="{{ isset($incident->date_cloture) ? $incident->date_cloture : now()->toDateString() }}">
    </div>

    {{-- QFC OUVERT --}}
    <div class="col-md-6">
        <label class="form-label">QFC ouvert n°</label>
        <input type="text" name="qfc_ouvert" class="form-control"
               value="{{ old('qfc_ouvert', $incident->qfc_ouvert ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- QFC FERMÉ --}}
    <div class="col-md-6">
        <label class="form-label">QFC fermé n°</label>
        <input type="text" name="qfc_ferme" class="form-control"
               value="{{ old('qfc_ferme', $incident->qfc_ferme ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- DESCRIPTION --}}
    <div class="col-12">
        <label class="form-label">Description & remarques <span class="text-danger">*</span></label>
        <textarea name="description" rows="4"
                  class="form-control @error('description') is-invalid @enderror"
                  {{ $ro }}>{{ old('description', $incident->description ?? '') }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- PHOTO OUVERTE --}}
    <div class="col-md-6">
        <label class="form-label">
            Photo ouverte
            <span class="text-muted small">(définit automatiquement la date d'émission)</span>
        </label>
        @if(!empty($incident->photo_ouverte ?? null))
            <div class="mb-2">
                <img src="{{ asset('storage/'.$incident->photo_ouverte) }}"
                     class="img-thumbnail" style="max-height: 120px;">
            </div>
        @endif
        <input type="file" name="photo_ouverte" class="form-control"
               accept="image/*" capture="environment"
               {{ $ro }}>
    </div>

    {{-- PHOTO FERMÉE --}}
    <div class="col-md-6">
        <label class="form-label">
            Photo fermée
            <span class="text-muted small">(définit automatiquement la date de mise à jour)</span>
        </label>
        @if(!empty($incident->photo_fermee ?? null))
            <div class="mb-2">
                <img src="{{ asset('storage/'.$incident->photo_fermee) }}"
                     class="img-thumbnail" style="max-height: 120px;">
            </div>
        @endif
        <input type="file" name="photo_fermee" class="form-control"
               accept="image/*" capture="environment"
               {{ $ro }}>
    </div>

</div>

<script>
function handleStatutChange(val) {
    const row = document.getElementById('rowDateCloture');
    if (val === 'fermer') {
        row.style.display = '';
    } else {
        row.style.display = 'none';
    }
}
// Init au chargement
document.addEventListener('DOMContentLoaded', function () {
    const sel = document.getElementById('selectStatut');
    if (sel) handleStatutChange(sel.value);
});
</script>