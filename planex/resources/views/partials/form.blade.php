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
        'na'       => '⬛ N/A',
        'ouvert'   => '🟥 Ouvert',
        'en_cours' => '🟧 En cours',
        'fermer'   => '🟩 Fermé',
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
        Incident <strong>fermé</strong> — seul le statut peut être modifié.
    </div>
@endif

<div class="row g-3">

    {{-- DISCIPLINE --}}
    <div class="col-md-6">
        <label class="form-label">
            Discipline <span class="text-danger">*</span>
        </label>
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
        @error('discipline')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- SYSTÈME --}}
    <div class="col-md-6">
        <label class="form-label">Système</label>
        <input type="text" name="systeme" class="form-control"
               value="{{ old('systeme', $incident->systeme ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- LOT DE TRAVAIL --}}
    <div class="col-md-6">
        <label class="form-label">Lot de travail</label>
        <input type="text" name="lot_travail" class="form-control"
               value="{{ old('lot_travail', $incident->lot_travail ?? '') }}"
               {{ $ro }}>
    </div>

    {{-- ZONE --}}
    <div class="col-md-6">
        <label class="form-label">Zone</label>
        <select name="zone_id" class="form-select" {{ $dis }}>
            <option value="">— Sélectionner —</option>
            @foreach($zones as $zone)
                <option value="{{ $zone->id }}"
                    {{ old('zone_id', $incident->zone_id ?? '') == $zone->id ? 'selected' : '' }}>
                    {{ $zone->name }}
                </option>
            @endforeach
        </select>
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
        <label class="form-label">Catégorie</label>
        <select name="categorie" class="form-select" {{ $dis }}>
            <option value="">— Sélectionner —</option>
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
        <label class="form-label">Statut</label>
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
        <label class="form-label">Clôture prévue</label>
        <input type="date" name="cloture_prevue" class="form-control"
               value="{{ old('cloture_prevue', isset($incident->cloture_prevue)
                   ? \Carbon\Carbon::parse($incident->cloture_prevue)->format('Y-m-d')
                   : '') }}"
               {{ $ro }}>
    </div>

    {{-- DATE CLÔTURE auto (affichée si statut = fermer) --}}
    <div class="col-md-6" id="rowDateCloture" style="display:none">
        <label class="form-label">Date de clôture</label>
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
        <label class="form-label">Description & remarques</label>
        <textarea name="description" rows="4" class="form-control"
                  {{ $ro }}>{{ old('description', $incident->description ?? '') }}</textarea>
    </div>

    {{-- ============================================================
         PHOTO OUVERTE
         — Nouveau incident  : obligatoire (required)
         — Modification      : optionnelle si déjà présente,
                               bouton supprimer disponible
    ============================================================= --}}
    <div class="col-md-6">
        <label class="form-label">
            Photo ouverte
            @if(!$isEdit)
                <span class="text-danger">*</span>
            @endif
            <span class="text-muted small">
                (définit automatiquement la date d'émission)
            </span>
        </label>

        {{-- Preview photo existante (mode edit) --}}
        @if($isEdit && !empty($incident->photo_ouverte))
            <div id="previewPhotoOuverte" class="mb-2">
                <img src="{{ asset('storage/'.$incident->photo_ouverte) }}"
                     class="img-thumbnail" style="max-height: 120px;">
            </div>
            <button type="button"
                    class="btn btn-sm btn-outline-danger mb-2"
                    id="btnSupprimerOuverte"
                    onclick="supprimerPhoto('ouverte')">
                🗑 Supprimer la photo
            </button>
        @else
            <div id="previewPhotoOuverte"></div>
        @endif

        {{-- Champ caché pour signaler la suppression au contrôleur --}}
        <input type="hidden" name="remove_photo_ouverte"
               id="removePhotoOuverte" value="0">

        {{-- Input fichier --}}
        <input type="file"
               name="photo_ouverte"
               id="inputPhotoOuverte"
               class="form-control @error('photo_ouverte') is-invalid @enderror"
               accept="image/*"
               {{ !$isEdit ? 'required' : '' }}
               {{ $ro }}
               onchange="previewImage(this, 'previewPhotoOuverte', 'removePhotoOuverte',
                                      'btnSupprimerOuverte')">
        @error('photo_ouverte')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- ============================================================
         PHOTO FERMÉE — toujours optionnelle
    ============================================================= --}}
    <div class="col-md-6">
        <label class="form-label">
            Photo fermée
            <span class="text-muted small">
                (définit automatiquement la date de mise à jour)
            </span>
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
                🗑 Supprimer la photo
            </button>
        @else
            <div id="previewPhotoFermee"></div>
        @endif

        <input type="hidden" name="remove_photo_fermee"
               id="removePhotoFermee" value="0">

        <input type="file"
               name="photo_fermee"
               id="inputPhotoFermee"
               class="form-control"
               accept="image/*"
               {{ $ro }}
               onchange="previewImage(this, 'previewPhotoFermee', 'removePhotoFermee',
                                      'btnSupprimerFermee')">
    </div>

</div>{{-- fin .row --}}

<script>
// ===== STATUT → affiche/masque date clôture =====
function handleStatutChange(val) {
    document.getElementById('rowDateCloture').style.display =
        val === 'fermer' ? '' : 'none';
}
document.addEventListener('DOMContentLoaded', function () {
    const sel = document.getElementById('selectStatut');
    if (sel) handleStatutChange(sel.value);
});

// ===== SUPPRIMER PHOTO =====
// type = 'ouverte' | 'fermee'
function supprimerPhoto(type) {
    const preview  = document.getElementById('previewPhoto' + cap(type));
    const input    = document.getElementById('inputPhoto'   + cap(type));
    const hidden   = document.getElementById('removePhoto'  + cap(type));
    const btn      = document.getElementById('btnSupprimer' + cap(type));

    // Masque preview + bouton supprimer
    if (preview) preview.innerHTML = '';
    if (btn)     btn.style.display = 'none';

    // Vide le file input
    if (input) input.value = '';

    // Si c'est la photo ouverte en mode création, la rendre obligatoire
    // (en edit on autorise la suppression + nouvelle upload)
    if (hidden) hidden.value = '1';
}

// ===== PREVIEW APRÈS SÉLECTION D'UN FICHIER =====
function previewImage(input, previewId, hiddenId, btnId) {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        const preview = document.getElementById(previewId);
        if (!preview) return;

        // Remplace ou crée l'image de preview
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

    // Annule une éventuelle suppression précédente
    const hidden = document.getElementById(hiddenId);
    if (hidden) hidden.value = '0';

    // Ré-affiche le bouton supprimer si besoin
    const btn = document.getElementById(btnId);
    if (btn) btn.style.display = '';
}

// Capitalise la première lettre (helper)
function cap(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>