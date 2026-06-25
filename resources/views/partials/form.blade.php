@isset($incident)
    @method('PUT')
@endisset

@php
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

    $currentChantierIdForm = old('chantier_id', $incident->chantier_id ?? '');
    $currentResponsabilite = old('responsabilite', $incident->responsabilite ?? '');
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

    {{-- CHANTIER --}}
    <div class="col-md-6">
        <label class="form-label">
            {{ __('messages.field_chantier') }} <span class="text-danger">*</span>
        </label>
        <div class="input-group">
            <select name="chantier_id" id="selectChantier"
                    class="form-select @error('chantier_id') is-invalid @enderror"
                    {{ $dis }} required>
                <option value="">{{ __('messages.select_placeholder') }}</option>
                @foreach($chantiers as $chantier)
                    <option value="{{ $chantier->id }}"
                        {{ $currentChantierIdForm == $chantier->id ? 'selected' : '' }}>
                        {{ $chantier->nom }} — {{ $chantier->localite }}
                    </option>
                @endforeach
            </select>
            @if(!$isFerme)
            <button type="button" class="btn btn-outline-secondary" title="{{ __('messages.modal_add_chantier') }}"
                    data-bs-toggle="modal" data-bs-target="#modalChantier">+</button>
            @endif
        </div>
        @error('chantier_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>

    {{-- DISCIPLINE (dépend du chantier) --}}
    <div class="col-md-6">
        <label class="form-label">
            {{ __('messages.field_discipline') }} <span class="text-danger">*</span>
        </label>
        <div class="input-group">
            <select id="selectDisciplineCouple"
                    class="form-select @error('discipline') is-invalid @enderror"
                    {{ $dis }} {{ $currentChantierIdForm ? '' : 'disabled' }}>
                <option value="">{{ $currentChantierIdForm ? __('messages.select_placeholder') : __('messages.form_pick_chantier_first') }}</option>
            </select>
            @if(!$isFerme)
            <button type="button" class="btn btn-outline-secondary" id="btnAddEntreprise" title="{{ __('messages.chantier_discipline_add') }}"
                    data-bs-toggle="modal" data-bs-target="#modalEntreprise">+</button>
            @endif
        </div>
        <input type="hidden" name="discipline" id="inputDiscipline"
               value="{{ old('discipline', $incident->discipline ?? '') }}">
        @error('discipline')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>

    {{-- RESPONSABILITÉ (auto depuis l'entreprise du couple) --}}
    <div class="col-md-6">
        <label class="form-label">
            {{ __('messages.field_responsibility') }} <span class="text-danger">*</span>
        </label>
        <input type="text" name="responsabilite" id="inputResponsabilite"
               class="form-control @error('responsabilite') is-invalid @enderror"
               value="{{ $currentResponsabilite }}" readonly required>
        @error('responsabilite')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
        <label class="form-label">
            {{ __('messages.field_zone') }}
            @if(isset($incident) && $incident->zone_reselect)
                <span class="badge bg-warning text-dark">⚠ {{ __('messages.zone_reselect_needed') }}</span>
            @endif
        </label>
        @if(isset($incident) && $incident->zone_reselect)
            <div class="alert alert-warning py-1 px-2 mb-1" style="font-size:12px">
                {{ __('messages.zone_reselect_banner') }}
            </div>
        @endif
        <div class="input-group">
            <select name="zone_id" id="selectZone" class="form-select" {{ $dis }}>
                <option value="">{{ __('messages.select_placeholder') }}</option>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}"
                        {{ old('zone_id', $incident->zone_id ?? '') == $zone->id ? 'selected' : '' }}>
                        {{ $zone->name }}
                    </option>
                @endforeach
            </select>
            @if(!$isFerme)
            <button type="button" class="btn btn-outline-secondary" title="{{ __('messages.modal_add_zone') }}"
                    data-bs-toggle="modal" data-bs-target="#modalZone">+</button>
            @endif
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

        <input type="file"
               name="photo_ouverte"
               id="inputPhotoOuverteCamera"
               class="d-none @error('photo_ouverte') is-invalid @enderror"
               accept="image/*"
               capture="environment"
               onchange="syncPhoto(this, 'inputPhotoOuverteGalerie', 'previewPhotoOuverte', 'removePhotoOuverte', 'btnSupprimerOuverte')">

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

        <input type="file"
               name="photo_fermee"
               id="inputPhotoFermeeCamera"
               class="d-none"
               accept="image/*"
               capture="environment"
               onchange="syncPhoto(this, 'inputPhotoFermeeGalerie', 'previewPhotoFermee', 'removePhotoFermee', 'btnSupprimerFermee')">

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

@if(!$isFerme)
{{-- ── MODALS d'ajout rapide ─────────────────────────────── --}}
<div class="modal fade" id="modalChantier" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">{{ __('messages.modal_add_chantier') }}</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
      <div class="mb-2"><label class="form-label">{{ __('messages.field_nom') }}</label>
        <input type="text" id="mc_nom" class="form-control" maxlength="255"></div>
      <div class="mb-2"><label class="form-label">{{ __('messages.field_localite') }}</label>
        <input type="text" id="mc_loc" class="form-control" maxlength="255"></div>
      <div class="text-danger small" id="mc_err"></div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.btn_back') }}</button>
      <button type="button" class="btn btn-primary" id="mc_save">{{ __('messages.btn_add') }}</button>
    </div>
  </div></div>
</div>

<div class="modal fade" id="modalEntreprise" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">{{ __('messages.chantier_discipline_add') }}</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
      <div class="mb-2"><label class="form-label">{{ __('messages.field_discipline') }}</label>
        <select id="me_disc" class="form-select">
          @foreach(\App\Models\Chantier::DISCIPLINES as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
          @endforeach
        </select></div>
      <div class="mb-2"><label class="form-label">{{ __('messages.chantier_discipline_name') }}</label>
        <input type="text" id="me_ent" class="form-control" maxlength="255"></div>
      <div class="text-danger small" id="me_err"></div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.btn_back') }}</button>
      <button type="button" class="btn btn-primary" id="me_save">{{ __('messages.btn_add') }}</button>
    </div>
  </div></div>
</div>

<div class="modal fade" id="modalZone" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">{{ __('messages.modal_add_zone') }}</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
      <div class="mb-2"><label class="form-label">{{ __('messages.field_zone') }}</label>
        <input type="text" id="mz_name" class="form-control" maxlength="100"></div>
      <div class="text-danger small" id="mz_err"></div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.btn_back') }}</button>
      <button type="button" class="btn btn-primary" id="mz_save">{{ __('messages.btn_add') }}</button>
    </div>
  </div></div>
</div>
@endif

<script>
const _baseUrl   = '{{ url("/chantiers") }}';
const _zoneUrl   = '{{ route("zones.store") }}';
const _csrf      = document.querySelector('input[name=_token]')?.value || '';
const _placeholder       = @json(__('messages.select_placeholder'));
const _currentDiscipline    = @json(old('discipline', $incident->discipline ?? ''));
const _currentResponsabilite = @json($currentResponsabilite);

const chantierSel    = document.getElementById('selectChantier');
const dispSel        = document.getElementById('selectDisciplineCouple');
const inputDiscipline = document.getElementById('inputDiscipline');
const inputResp      = document.getElementById('inputResponsabilite');

function setFromSelect(isInitial) {
    const opt = dispSel.options[dispSel.selectedIndex];
    if (opt && opt.value) {
        inputDiscipline.value = opt.dataset.discipline || '';
        inputResp.value       = opt.dataset.entreprise || '';
    } else if (!isInitial) {
        inputDiscipline.value = '';
        inputResp.value       = '';
    }
    // En édition sans correspondance : on conserve les valeurs déjà stockées.
}

async function loadDisciplines(chantierId, isInitial, selectId) {
    dispSel.innerHTML = '<option value="">' + _placeholder + '</option>';
    dispSel.disabled = true;
    if (!chantierId) { setFromSelect(isInitial); return; }
    try {
        const r = await fetch(_baseUrl + '/' + chantierId + '/disciplines', { headers: { 'Accept': 'application/json' } });
        const couples = await r.json();
        couples.forEach(c => {
            const o = document.createElement('option');
            o.value = c.id;
            o.textContent = c.label + (c.entreprise ? ' — ' + c.entreprise : '');
            o.dataset.discipline = c.discipline_label;
            o.dataset.entreprise = c.entreprise || '';
            dispSel.appendChild(o);
        });
        dispSel.disabled = false;
        if (selectId) {
            dispSel.value = selectId;
        } else if (isInitial && _currentDiscipline) {
            const match = couples.find(c => c.discipline_label === _currentDiscipline
                && (c.entreprise || '') === (_currentResponsabilite || ''));
            if (match) dispSel.value = match.id;
        }
        setFromSelect(isInitial && !selectId);
    } catch (e) {}
}

if (chantierSel) {
    chantierSel.addEventListener('change', function () { loadDisciplines(this.value, false); });
    if (dispSel) dispSel.addEventListener('change', function () { setFromSelect(false); });
    if (chantierSel.value) loadDisciplines(chantierSel.value, true);
}

// ── Modals d'ajout rapide (chantier / entreprise / zone) ──────
function _post(url, data) {
    return fetch(url, {
        method: 'POST',
        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest',
                   'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(Object.assign({ _token: _csrf }, data))
    }).then(r => r.ok ? r.json() : r.json().then(e => Promise.reject(e)));
}
function _hide(id) {
    const m = bootstrap.Modal.getInstance(document.getElementById(id));
    if (m) m.hide();
}

// Chantier
const mcSave = document.getElementById('mc_save');
if (mcSave) mcSave.addEventListener('click', function () {
    const nom = document.getElementById('mc_nom').value.trim();
    const loc = document.getElementById('mc_loc').value.trim();
    const err = document.getElementById('mc_err'); err.textContent = '';
    if (!nom || !loc) { err.textContent = '⚠️'; return; }
    _post(_baseUrl, { nom: nom, localite: loc }).then(d => {
        const o = document.createElement('option');
        o.value = d.id; o.textContent = d.label; o.selected = true;
        chantierSel.appendChild(o);
        _hide('modalChantier');
        document.getElementById('mc_nom').value = ''; document.getElementById('mc_loc').value = '';
        loadDisciplines(d.id, false);
    }).catch(e => { err.textContent = (e && e.message) || 'Erreur'; });
});

// Entreprise (couple discipline+entreprise sur le chantier sélectionné)
const meSave = document.getElementById('me_save');
if (meSave) meSave.addEventListener('click', function () {
    const cid = chantierSel.value;
    const err = document.getElementById('me_err'); err.textContent = '';
    if (!cid) { err.textContent = @json(__('messages.form_pick_chantier_first')); return; }
    const discipline = document.getElementById('me_disc').value;
    const entreprise = document.getElementById('me_ent').value.trim();
    if (!entreprise) { err.textContent = '⚠️'; return; }
    _post(_baseUrl + '/' + cid + '/disciplines', { discipline: discipline, entreprise: entreprise }).then(d => {
        _hide('modalEntreprise');
        document.getElementById('me_ent').value = '';
        loadDisciplines(cid, false, d.id);
    }).catch(e => { err.textContent = (e && e.error) || 'Erreur'; });
});

// Zone
const mzSave = document.getElementById('mz_save');
if (mzSave) mzSave.addEventListener('click', function () {
    const name = document.getElementById('mz_name').value.trim();
    const err = document.getElementById('mz_err'); err.textContent = '';
    if (!name) { err.textContent = '⚠️'; return; }
    _post(_zoneUrl, { name: name }).then(d => {
        const sel = document.getElementById('selectZone');
        const o = document.createElement('option');
        o.value = d.id; o.textContent = d.name; o.selected = true;
        sel.appendChild(o);
        _hide('modalZone');
        document.getElementById('mz_name').value = '';
    }).catch(e => { err.textContent = (e && e.message) || 'Erreur'; });
});

// Évite que l'input fichier VIDE (caméra ou galerie, même name) n'écrase
// celui qui contient la photo : on désactive les inputs fichier vides avant
// l'envoi (un input désactivé n'est pas soumis).
(function () {
    const ref = document.getElementById('inputPhotoOuverteCamera');
    const form = ref ? ref.form : null;
    if (!form) return;
    form.addEventListener('submit', function () {
        form.querySelectorAll('input[type=file]').forEach(function (inp) {
            if (!inp.files || inp.files.length === 0) inp.disabled = true;
        });
    });
})();

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

function syncPhoto(input, otherId, previewId, hiddenId, btnId) {
    const file = input.files[0];
    if (!file) return;

    const other = document.getElementById(otherId);
    if (other) other.value = '';

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
