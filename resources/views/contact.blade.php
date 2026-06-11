@extends('layouts.app')

@section('title', 'Contact — PlanEx')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8" style="max-width:700px">

            <div class="text-center mb-4">
                <h1 class="fw-bold" style="font-size:1.7rem;">{{ __('messages.contact_title') }}</h1>
                <p class="text-muted mt-2" style="font-size:0.97rem;">
                    {{ __('messages.contact_intro') }}
                </p>
            </div>

            <div class="card shadow-sm border-0" style="border-radius:12px;overflow:hidden;">
                <div class="card-header py-3 px-4" style="background:#111;border-bottom:3px solid #e30613;">
                    <span class="fw-semibold text-white" style="font-size:1rem;">{{ __('messages.contact_card_header') }}</span>
                </div>
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.submit') }}" enctype="multipart/form-data" id="contactForm" novalidate>
                        @csrf

                        {{-- Question 1 --}}
                        <div class="mb-3">
                            <label for="question_1" class="form-label fw-semibold">{{ __('messages.contact_q1_label') }} <span class="text-danger">*</span></label>
                            <select id="question_1" name="question_1" class="form-select @error('question_1') is-invalid @enderror" required>
                                <option value="">{{ __('messages.contact_select_cat') }}</option>
                                <option value="connexion"   {{ old('question_1') === 'connexion'   ? 'selected' : '' }}>{{ __('messages.contact_opt_connexion') }}</option>
                                <option value="anomalies"  {{ old('question_1') === 'anomalies'   ? 'selected' : '' }}>{{ __('messages.contact_opt_anomalies') }}</option>
                                <option value="suggestion" {{ old('question_1') === 'suggestion'  ? 'selected' : '' }}>{{ __('messages.contact_opt_suggestion') }}</option>
                                <option value="abonnement" {{ old('question_1') === 'abonnement'  ? 'selected' : '' }}>{{ __('messages.contact_opt_abonnement') }}</option>
                                <option value="autre"      {{ old('question_1') === 'autre'       ? 'selected' : '' }}>{{ __('messages.contact_opt_autre') }}</option>
                            </select>
                            @error('question_1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Question 2 (dynamique) --}}
                        <div class="mb-3" id="q2Wrapper" style="display:none;">
                            <label for="question_2" class="form-label fw-semibold">{{ __('messages.contact_q2_label') }} <span class="text-danger">*</span></label>
                            <select id="question_2" name="question_2" class="form-select @error('question_2') is-invalid @enderror">
                                <option value="">{{ __('messages.contact_select') }}</option>
                            </select>
                            @error('question_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Message --}}
                        <div class="mb-3">
                            <label for="message" class="form-label fw-semibold">{{ __('messages.contact_message_label') }} <span class="text-danger">*</span></label>
                            <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror"
                                rows="6" maxlength="2500" placeholder="{{ __('messages.contact_message_ph') }}" required>{{ old('message') }}</textarea>
                            <div class="d-flex justify-content-end mt-1">
                                <small id="charCount" class="text-muted">0 {{ __('messages.contact_chars') }}</small>
                            </div>
                            @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('messages.contact_email_label') }} <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="exemple@email.com" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Pièces jointes PDF --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">{{ __('messages.contact_pdf_label') }} <span class="text-muted fw-normal">{{ __('messages.contact_optional2') }}</span></label>
                            <input type="file" name="pdfs[]" id="pdfsInput" class="d-none @error('pdfs.*') is-invalid @enderror"
                                accept=".pdf,application/pdf" multiple
                                onchange="updateFileLabel(this, 'pdfsLabel')">
                            <div class="input-group">
                                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('pdfsInput').click()">
                                    📎 {{ __('messages.contact_browse') }}
                                </button>
                                <span class="form-control text-truncate" id="pdfsLabel">{{ __('messages.contact_no_file') }}</span>
                            </div>
                            <div class="form-text">{{ __('messages.contact_pdf_formats') }}</div>
                            @error('pdfs.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        {{-- Pièces jointes images --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">{{ __('messages.contact_img_label') }} <span class="text-muted fw-normal">{{ __('messages.contact_optional10') }}</span></label>
                            <input type="file" name="images[]" id="imagesInput" class="d-none @error('images.*') is-invalid @enderror"
                                accept="image/*" multiple
                                onchange="updateFileLabel(this, 'imagesLabel')">
                            <div class="input-group">
                                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('imagesInput').click()">
                                    🖼️ {{ __('messages.contact_browse') }}
                                </button>
                                <span class="form-control text-truncate" id="imagesLabel">{{ __('messages.contact_no_file') }}</span>
                            </div>
                            <div class="form-text">{{ __('messages.contact_img_formats') }}</div>
                            @error('images.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        {{-- Bouton submit --}}
                        <div class="text-end">
                            <button type="submit" id="submitBtn" class="btn btn-danger px-4 py-2 fw-semibold" disabled>
                                {{ __('messages.contact_submit') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Modal succès --}}
@if(session('ticket_submitted'))
<div class="modal fade" id="ticketModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0" style="background:#111;">
                <h5 class="modal-title text-white fw-bold">{{ __('messages.contact_modal_title') }}</h5>
            </div>
            <div class="modal-body pt-3 pb-4 px-4">
                <div class="text-center mb-3">
                    <span style="font-size:3rem;">&#10003;</span>
                </div>
                <p class="text-center mb-0" style="font-size:1rem;">
                    {{ __('messages.contact_modal_body') }}
                </p>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn btn-dark px-4" data-bs-dismiss="modal">{{ __('messages.contact_modal_close') }}</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('ticketModal'));
        modal.show();
    });
</script>
@endif

<script>
const subQuestions = {
    'connexion':  [@json(__('messages.contact_sq_conn_username')), @json(__('messages.contact_sq_conn_password')), @json(__('messages.contact_opt_autre'))],
    'anomalies':  [@json(__('messages.contact_sq_ano_add')), @json(__('messages.contact_sq_ano_zone')), @json(__('messages.contact_sq_ano_pdf')), @json(__('messages.contact_sq_ano_tab')), @json(__('messages.contact_opt_autre'))],
    'suggestion': [@json(__('messages.contact_sq_sug_translation')), @json(__('messages.contact_sq_sug_info')), @json(__('messages.contact_opt_autre'))],
    'abonnement': [@json(__('messages.contact_sq_abo_regulate')), @json(__('messages.contact_sq_abo_newoption')), @json(__('messages.contact_sq_abo_details')), @json(__('messages.contact_opt_autre'))],
    'autre':      [@json(__('messages.contact_sq_autre_tabs')), @json(__('messages.contact_sq_autre_other'))]
};
const charsSuffix = @json(__('messages.contact_chars'));
const selectPlaceholder = @json(__('messages.contact_select'));
const noFileText = @json(__('messages.contact_no_file'));
const filesCountText = @json(__('messages.contact_files_count'));

function updateFileLabel(input, labelId) {
    const label = document.getElementById(labelId);
    if (!label) return;
    const n = input.files.length;
    if (n === 0) {
        label.textContent = noFileText;
    } else if (n === 1) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = n + ' ' + filesCountText;
    }
}

const q1        = document.getElementById('question_1');
const q2        = document.getElementById('question_2');
const q2Wrap    = document.getElementById('q2Wrapper');
const msgArea   = document.getElementById('message');
const emailInp  = document.getElementById('email');
const submitBtn = document.getElementById('submitBtn');
const charCount = document.getElementById('charCount');

function populateQ2(val) {
    q2.innerHTML = '<option value="">' + selectPlaceholder + '</option>';
    if (val && subQuestions[val]) {
        subQuestions[val].forEach(function(opt) {
            var o = document.createElement('option');
            o.value = opt;
            o.textContent = opt;
            q2.appendChild(o);
        });
        q2Wrap.style.display = '';
    } else {
        q2Wrap.style.display = 'none';
        q2.value = '';
    }
}

// Restaurer les anciennes valeurs après erreur de validation
(function(){
    var oldQ1 = @json(old('question_1', ''));
    var oldQ2 = @json(old('question_2', ''));
    if (oldQ1) {
        populateQ2(oldQ1);
        if (oldQ2) { q2.value = oldQ2; }
    }
    if (msgArea.value.length > 0) {
        charCount.textContent = msgArea.value.length + ' ' + charsSuffix;
    }
    checkForm();
})();

q1.addEventListener('change', function () {
    populateQ2(this.value);
    checkForm();
});
q2.addEventListener('change', checkForm);
msgArea.addEventListener('input', function () {
    charCount.textContent = this.value.length + ' ' + charsSuffix;
    checkForm();
});
emailInp.addEventListener('input', checkForm);

function checkForm() {
    var q1ok    = q1.value !== '';
    var q2ok    = q2Wrap.style.display !== 'none' && q2.value !== '';
    var msgok   = msgArea.value.trim().length >= 1;
    var emailok = emailInp.value.trim() !== '' && emailInp.validity.valid;
    submitBtn.disabled = !(q1ok && q2ok && msgok && emailok);
}

checkForm();
</script>
@endsection
