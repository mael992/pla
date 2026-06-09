@extends('layouts.app')

@section('title', 'Ticket ' . $ticket->numero . ' — PlanEx')

@section('content')
<div class="container py-4" style="max-width:800px;">

    {{-- En-tête --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius:10px;overflow:hidden;">
        <div class="card-header py-3 px-4" style="background:#111;border-bottom:3px solid #e30613;">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <span class="text-white fw-bold">Ticket {{ $ticket->numero }}</span>
                @if($ticket->statut === 'ouvert')
                    <span class="badge bg-success">Ouvert</span>
                @elseif($ticket->statut === 'cloture')
                    <span class="badge bg-secondary">Clôturé</span>
                @elseif($ticket->statut === 'reouverture_demandee')
                    <span class="badge bg-warning text-dark">Réouverture en cours d'examen</span>
                @endif
            </div>
        </div>
        <div class="card-body px-4 py-3 small text-muted">
            <strong>Catégorie :</strong> {{ $ticket->question_1 }} &mdash; {{ $ticket->question_2 }}
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Conversation --}}
    <div class="mb-4">
        @foreach($ticket->messages as $msg)
            @if($msg->sender === 'admin')
            <div class="d-flex justify-content-end mb-3">
                <div style="max-width:85%;">
                    <div class="text-end mb-1 small text-muted">
                        <strong>Équipe PlanEx</strong> &mdash; {{ $msg->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="p-3 rounded-3 text-white"
                         style="background:#111;border-bottom-right-radius:4px!important;white-space:pre-wrap;font-size:0.95rem;">{{ $msg->body }}</div>
                    @if($msg->attachments->count())
                    <div class="mt-2 d-flex flex-wrap gap-2 justify-content-end">
                        @foreach($msg->attachments as $att)
                            <a href="{{ Storage::url($att->path) }}" target="_blank"
                               class="btn btn-sm btn-outline-secondary" style="font-size:0.8rem;">
                                @if(str_starts_with($att->mime_type, 'image/')) &#128247; @else &#128196; @endif
                                {{ $att->original_name }}
                            </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @else
            <div class="d-flex justify-content-start mb-3">
                <div style="max-width:85%;">
                    <div class="mb-1 small text-muted">
                        <strong>Vous</strong> &mdash; {{ $msg->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="p-3 rounded-3"
                         style="background:#f1f3f5;border-bottom-left-radius:4px!important;white-space:pre-wrap;font-size:0.95rem;">{{ $msg->body }}</div>
                    @if($msg->attachments->count())
                    <div class="mt-2 d-flex flex-wrap gap-2">
                        @foreach($msg->attachments as $att)
                            <a href="{{ Storage::url($att->path) }}" target="_blank"
                               class="btn btn-sm btn-outline-secondary" style="font-size:0.8rem;">
                                @if(str_starts_with($att->mime_type, 'image/')) &#128247; @else &#128196; @endif
                                {{ $att->original_name }}
                            </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endif
        @endforeach
    </div>

    {{-- Zone de réponse ou statut fermé --}}
    @if($ticket->statut === 'ouvert')

        <div class="card border-0 shadow-sm" style="border-radius:10px;">
            <div class="card-body p-4">
                <h5 class="fw-semibold mb-3">Ajouter un message</h5>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('message.reply', $ticket->token) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <textarea name="body" id="replyBody" class="form-control @error('body') is-invalid @enderror"
                            rows="5" placeholder="Votre message..."
                            @if(!$ticket->no_char_limit_next) maxlength="2500" @endif
                            required>{{ old('body') }}</textarea>
                        @if(!$ticket->no_char_limit_next)
                        <div class="d-flex justify-content-end mt-1">
                            <small id="replyCharCount" class="text-muted">0 / 2500 caractères</small>
                        </div>
                        @endif
                        @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Documents PDF <span class="text-muted fw-normal">(max 2)</span></label>
                        <input type="file" name="pdfs[]" class="form-control form-control-sm" accept=".pdf,application/pdf" multiple>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Photos / Images <span class="text-muted fw-normal">(max 10)</span></label>
                        <input type="file" name="images[]" class="form-control form-control-sm" accept="image/*" multiple>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-dark px-4">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>

        @if(!$ticket->no_char_limit_next)
        <script>
        (function(){
            var ta = document.getElementById('replyBody');
            var cc = document.getElementById('replyCharCount');
            if (ta && cc) {
                ta.addEventListener('input', function(){
                    cc.textContent = this.value.length + ' / 2500 caractères';
                });
                cc.textContent = ta.value.length + ' / 2500 caractères';
            }
        })();
        </script>
        @endif

    @elseif($ticket->statut === 'reouverture_demandee')

        <div class="alert alert-warning d-flex align-items-center gap-3" style="border-radius:10px;">
            <span style="font-size:1.5rem;">&#9201;</span>
            <div>
                <strong>Votre demande de réouverture est en cours d'examen.</strong><br>
                <span class="text-muted small">Notre équipe reviendra vers vous prochainement.</span>
            </div>
        </div>

    @elseif($ticket->statut === 'cloture')

        <div class="card border-0 shadow-sm" style="border-radius:10px;overflow:hidden;">
            <div class="card-body p-4 text-center">
                <p class="mb-1 fw-semibold" style="font-size:1rem;">Ce ticket est clôturé.</p>
                @if($ticket->delete_at)
                <p class="text-muted small mb-3">
                    Vous disposez d'un délai jusqu'au <strong>{{ $ticket->delete_at->format('d/m/Y') }}</strong>
                    pour demander la réouverture.
                </p>
                @endif
                <form method="POST" action="{{ route('message.reopen', $ticket->token) }}"
                      onsubmit="return confirm('Envoyer une demande de réouverture ?')">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark px-4">
                        Demander la réouverture
                    </button>
                </form>
            </div>
        </div>

    @endif

</div>
@endsection
