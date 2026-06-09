@isset($incident)
    @method('PUT')
@endisset

@php
    $disciplines = [
        'VRD', 'Génie civil', 'Structure métallique', 'Structure bâtiment',
        'Équipement', 'Tuyauterie', 'Calorifuge',
        'Électricité', 'Instrumentation', 'Automatisme',
    ];

    $statuts = [
        'na'       => __('messages.status_na'),
        'ouvert'   => __('messages.status_open'),
        'en_cours' => __('messages.status_in_progress'),
        'fermer'   => __('messages.status_closed'),
    ];

    $isFerme  = isset($incident) && $incident->statut === 'fermer';
    $isEdit   = isset($incident);
    $ro       = $isFerme ? 'readonly' : '';
    $dis      = $isFerme ? 'disabled' : '';
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
        {!! __('messages.form_incident_closed') !!}
    </div>
@endif

<div class="row g-3">

    {{-- DISCIPLINE --}}
    <div class="col-md-6">
        <label class="form-label">
            {{ __('messages.field_discipline') }} <span class="text-danger">*</span>
        </label>
        <select name="discipline"
                class="form-select @error('discipline') is-invalid @enderror"
                {{ $dis }}>
            <option value="">{{ __('messages.select_placeholder') }}</option>
            @foreach($disciplines as $d)
                <option value="{{ $d }}"
                    {{ old('discipline', $incident->discipline ?? '') === $d ? 'selected' : '' }}>
                    {{ $d }}
                </option>
            @endforeach
        </select>
        @error('discipline')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- SYSTÈME --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_system') }}</label>
        <input type="text" name="systeme" class="form-control"
               value="{{ old('systeme', $incident->systeme ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- LOT DE TRAVAIL --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_work_lot') }}</label>
        <input type="text" name="lot_travail" class="form-control"
               value="{{ old('lot_travail', $incident->lot_travail ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- ZONE --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_zone') }}</label>
        <select name="zone_id" class="form-select" {{ $dis }}>
            <option value="">{{ __('messages.select_placeholder') }}</option>
            @foreach($zones as $zone)
                <option value="{{ $zone->id }}"
                    {{ old('zone_id', $incident->zone_id ?? '') == $zone->id ? 'selected' : '' }}>
                    {{ $zone->name }}
                </option>
            @endforeach
        </select>
        <div class="form-text">
            <a href="{{ route('zones.index') }}" target="_blank">{{ __('messages.form_manage_zones') }}</a>
        </div>
    </div>

    {{-- CHANTIER --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_chantier') }}</label>
        <select name="chantier_id" class="form-select" {{ $dis }}>
            <option value="">{{ __('messages.select_placeholder') }}</option>
            @foreach($chantiers as $chantier)
                <option value="{{ $chantier->id }}"
                    {{ old('chantier_id', $incident->chantier_id ?? '') == $chantier->id ? 'selected' : '' }}>
                    {{ $chantier->nom }} — {{ $chantier->localite }}
                </option>
            @endforeach
        </select>
        <div class="form-text">
            <a href="{{ route('chantiers.index') }}" target="_blank">{{ __('messages.chantiers_title') }}</a>
        </div>
    </div>

    {{-- ÉTIQUETTE --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_label') }}</label>
        <input type="text" name="etiquette" class="form-control"
               value="{{ old('etiquette', $incident->etiquette ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- CATÉGORIE --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_category') }}</label>
        <select name="categorie" class="form-select" {{ $dis }}>
            <option value="">{{ __('messages.select_placeholder') }}</option>
            @foreach(\App\Models\Incident::CATEGORIES as $key => $label)
                <option value="{{ $key }}"
                    {{ old('categorie', $incident->categorie ?? '') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- INTERNE --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_internal') }}</label>
        <input type="text" name="interne" class="form-control"
               value="{{ old('interne', $incident->interne ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- RESPONSABILITÉ --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_responsibility') }}</label>
        <input type="text" name="responsabilite" class="form-control"
               value="{{ old('responsabilite', $incident->responsabilite ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- STATUT --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_status') }}</label>
        <select name="statut" class="form-select" id="selectStatut"
                onchange="handleStatutChange(this.value)">
            @foreach($statuts as $val => $label)
                <option value="{{ $val }}"
                    {{ old('statut', $incident->statut ?? 'ouvert') === $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- CLÔTURE PRÉVUE --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_planned_closure') }}</label>
        <input type="date" name="cloture_prevue" class="form-control"
               value="{{ old('cloture_prevue', isset($incident->cloture_prevue)
                   ? \Carbon\Carbon::parse($incident->cloture_prevue)->format('Y-m-d')
                   : '') }}"
               {{ $ro }}>
    </div>

    {{-- DATE CLÔTURE --}}
    <div class="col-md-6" id="rowDateCloture" style="display:none">
        <label class="form-label">{{ __('messages.field_closure_date') }}</label>
        <input type="text" class="form-control bg-light"
               value="{{ isset($incident->date_cloture)
                   ? \Carbon\Carbon::parse($incident->date_cloture)->format('d/m/Y')
                   : now()->format('d/m/Y') }}"
               readonly>
        <input type="hidden" name="date_cloture"
               value="{{ isset($incident->date_cloture)
                   ? $incident->date_cloture
                   : now()->toDateString() }}">
    </div>

    {{-- QFC OUVERT --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_qfc_open_form') }}</label>
        <input type="text" name="qfc_ouvert" class="form-control"
               value="{{ old('qfc_ouvert', $incident->qfc_ouvert ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- QFC FERMÉ --}}
    <div class="col-md-6">
        <label class="form-label">{{ __('messages.field_qfc_closed_form') }}</label>
        <input type="text" name="qfc_ferme" class="form-control"
               value="{{ old('qfc_ferme', $incident->qfc_ferme ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- DESCRIPTION --}}
    <div class="col-12">
        <label class="form-label">{{ __('messages.field_description') }}</label>
        <textarea name="description" rows="4" class="form-control"
                  {{ $ro }}>{{ old('description', $incident->description ?? '') }}</textarea>
    </div>

    {{-- PHOTO OUVERTE --}}
    <div class="col-md-6">
        <label class="form-label">
            {{ __('messages.field_photo_open') }}
            @if(!$isEdit)
                <span class="text-danger">*</span>
            @endif
            <span class="text-muted small">{{ __('messages.photo_sets_issue_date') }}</span>
        </label>

        @if($isEdit && !empty($incident->photo_ouverte))
            <div id="previewPhotoOuverte" class="mb-2">
                <img src="{{ asset('storage/'.$incident->photo_ouverte) }}"
                     class="img-thumbnail" style="max-height: 120px;">
            </div>
            <button type="button"
                    class="btn btn-sm btn-outline-danger mb-2"
                    id="btnSupprimerOuverte"
                    onclick="supprimerPhoto('ouverte')">
                {{ __('messages.photo_delete') }}
            </button>
        @else
            <div id="previewPhotoOuverte"></div>
        @endif

        <input type="hidden" name="remove_photo_ouverte"
               id="removePhotoOuverte" value="0">

        {{-- Input caméra (capture direct, contourne le Photo Picker Android) --}}
        <input type="file"
               name="photo_ouverte"
               id="inputPhotoOuverteCamera"
               class="d-none @error('photo_ouverte') is-invalid @enderror"
               accept="image/*"
               capture="environment"
               onchange="syncPhoto(this, 'inputPhotoOuverteGalerie', 'previewPhotoOuverte', 'removePhotoOuverte', 'btnSupprimerOuverte')">

        {{-- Input galerie --}}
        <input type="file"
               name="photo_ouverte"
               id="inputPhotoOuverteGalerie"
               class="d-none @error('photo_ouverte') is-invalid @enderror"
               accept="image/*"
               onchange="syncPhoto(this, 'inputPhotoOuverteCamera', 'previewPhotoOuverte', 'removePhotoOuverte', 'btnSupprimerOuverte')">

        @if(!$isFerme)
        <div class="d-flex gap-2 flex-wrap">
            <button type="button" class="btn btn-outline-primary btn-sm"
                    onclick="document.getElementById('inputPhotoOuverteCamera').click()">
                📷 {{ __('messages.photo_take') }}
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm"
                    onclick="document.getElementById('inputPhotoOuverteGalerie').click()">
                🖼️ {{ __('messages.photo_gallery') }}
            </button>
        </div>
        @endif

        @error('photo_ouverte')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- PHOTO FERMÉE --}}
    <div class="col-md-6">
        <label class="form-label">
            {{ __('messages.field_photo_closed') }}
            <span class="text-muted small">{{ __('messages.photo_sets_update_date') }}</span>
        </label>

        @if($isEdit && !empty($incident->photo_fermee))
            <div id="previewPhotoFermee" class="mb-2">
                <img src="{{ asset('storage/'.$incident->photo_fermee) }}"
                     class="img-thumbnail" style="max-height: 120px;">
            </div>
            <button type="button"
                    class="btn btn-sm btn-outline-danger mb-2"
                    id="btnSupprimerFermee"
                    onclick="supprimerPhoto('fermee')">
                {{ __('messages.photo_delete') }}
            </button>
        @else
            <div id="previewPhotoFermee"></div>
        @endif

        <input type="hidden" name="remove_photo_fermee"
               id="removePhotoFermee" value="0">

        {{-- Input caméra --}}
        <input type="file"
               name="photo_fermee"
               id="inputPhotoFermeeCamera"
               class="d-none"
               accept="image/*"
               capture="environment"
               onchange="syncPhoto(this, 'inputPhotoFermeeGalerie', 'previewPhotoFermee', 'removePhotoFermee', 'btnSupprimerFermee')">

        {{-- Input galerie --}}
        <input type="file"
               name="photo_fermee"
               id="inputPhotoFermeeGalerie"
               class="d-none"
               accept="image/*"
               onchange="syncPhoto(this, 'inputPhotoFermeeCamera', 'previewPhotoFermee', 'removePhotoFermee', 'btnSupprimerFermee')">

        @if(!$isFerme)
        <div class="d-flex gap-2 flex-wrap">
            <button type="button" class="btn btn-outline-primary btn-sm"
                    onclick="document.getElementById('inputPhotoFermeeCamera').click()">
                📷 {{ __('messages.photo_take') }}
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm"
                    onclick="document.getElementById('inputPhotoFermeeGalerie').click()">
                🖼️ {{ __('messages.photo_gallery') }}
            </button>
        </div>
        @endif
    </div>

</div>

<script>
function handleStatutChange(val) {
    document.getElementById('rowDateCloture').style.display =
        val === 'fermer' ? '' : 'none';
}
document.addEventListener('DOMContentLoaded', function () {
    const sel = document.getElementById('selectStatut');
    if (sel) handleStatutChange(sel.value);
});

function supprimerPhoto(type) {
    const capType  = cap(type);
    const preview  = document.getElementById('previewPhoto'         + capType);
    const inputCam = document.getElementById('inputPhoto' + capType + 'Camera');
    const inputGal = document.getElementById('inputPhoto' + capType + 'Galerie');
    const hidden   = document.getElementById('removePhoto'          + capType);
    const btn      = document.getElementById('btnSupprimer'         + capType);

    if (preview)  preview.innerHTML = '';
    if (btn)      btn.style.display = 'none';
    if (inputCam) inputCam.value = '';
    if (inputGal) inputGal.value = '';
    if (hidden)   hidden.value = '1';
}

/**
 * Appelée quand un input (caméra ou galerie) reçoit un fichier.
 * Affiche la prévisualisation et vide l'autre input (évite un double envoi).
 */
function syncPhoto(input, otherId, previewId, hiddenId, btnId) {
    const file = input.files[0];
    if (!file) return;

    // Vider l'autre input pour ne pas envoyer deux fichiers
    const other = document.getElementById(otherId);
    if (other) other.value = '';

    // Prévisualisation
    const reader = new FileReader();
    reader.onload = function (e) {
        const preview = document.getElementById(previewId);
        if (!preview) return;
        let img = preview.querySelector('img');
        if (!img) {
            img = document.createElement('img');
            img.className = 'img-thumbnail';
            img.style.maxHeight = '120px';
            preview.appendChild(img);
        }
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);

    const hidden = document.getElementById(hiddenId);
    if (hidden) hidden.value = '0';
    const btn = document.getElementById(btnId);
    if (btn) btn.style.display = '';
}

function cap(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>
