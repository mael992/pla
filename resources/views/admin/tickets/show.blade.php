@extends('layouts.app')

@section('title', 'Ticket ' . $ticket->numero . ' — Admin PlanEx')

@section('content')
<div class="container py-4" style="max-width:860px;">

    {{-- En-tête --}}
    <div class="mb-4">
        <a href="{{ route('admin.tickets.index') }}" class="text-decoration-none text-muted small">&larr; Retour à la liste</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4" style="border-radius:10px;overflow:hidden;">
        <div class="card-header py-3 px-4" style="background:#111;border-bottom:3px solid #e30613;">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <span class="text-white fw-bold">Ticket {{ $ticket->numero }}</span>
                @if($ticket->statut === 'ouvert')
                    <span class="badge bg-success">Ouvert</span>
                @elseif($ticket->statut === 'cloture')
                    <span class="badge bg-secondary">Clôturé</span>
                @elseif($ticket->statut === 'reouverture_demandee')
                    <span class="badge bg-warning text-dark">Réouverture demandée</span>
                @endif
            </div>
        </div>
        <div class="card-body px-4 py-3">
            <div class="row g-2 small text-muted">
                <div class="col-sm-6"><strong>Email :</strong> {{ $ticket->email }}</div>
                <div class="col-sm-6"><strong>Date :</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</div>
                <div class="col-sm-6"><strong>Catégorie :</strong> {{ $ticket->question_1 }}</div>
                <div class="col-sm-6"><strong>Sous-catégorie :</strong> {{ $ticket->question_2 }}</div>
                @if($ticket->statut === 'cloture' && $ticket->delete_at)
                <div class="col-12"><strong>Suppression automatique le :</strong> {{ $ticket->delete_at->format('d/m/Y') }}</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Conversation --}}
    <div class="mb-4">
        <h5 class="fw-semibold mb-3">Conversation</h5>

        @foreach($ticket->messages as $msg)
            @if($msg->sender === 'admin')
            <div class="d-flex justify-content-end mb-3">
                <div style="max-width:80%;">
                    <div class="text-end mb-1 small text-muted">
                        <strong>Admin PlanEx</strong> &mdash; {{ $msg->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="p-3 rounded-3 text-white"
                         style="background:#111;border-bottom-right-radius:4px!important;white-space:pre-wrap;font-size:0.95rem;">{{ $msg->body }}</div>
                    @if($msg->attachments->count())
                    <div class="mt-2 d-flex flex-wrap gap-2 justify-content-end">
                        @foreach($msg->attachments as $att)
                            <a href="{{ Storage::url($att->path) }}" target="_blank"
                               class="btn btn-sm btn-outline-secondary" style="font-size:0.8rem;">
                                @if(str_starts_with($att->mime_type, 'image/'))
                                    &#128247;
                                @else
                                    &#128196;
                                @endif
                                {{ $att->original_name }}
                            </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @else
            <div class="d-flex justify-content-start mb-3">
                <div style="max-width:80%;">
                    <div class="mb-1 small text-muted">
                        <strong>Client</strong> &mdash; {{ $msg->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="p-3 rounded-3"
                         style="background:#f1f3f5;border-bottom-left-radius:4px!important;white-space:pre-wrap;font-size:0.95rem;">{{ $msg->body }}</div>
                    @if($msg->attachments->count())
                    <div class="mt-2 d-flex flex-wrap gap-2">
                        @foreach($msg->attachments as $att)
                            <a href="{{ Storage::url($att->path) }}" target="_blank"
                               class="btn btn-sm btn-outline-secondary" style="font-size:0.8rem;">
                                @if(str_starts_with($att->mime_type, 'image/'))
                                    &#128247;
                                @else
                                    &#128196;
                                @endif
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

    {{-- Formulaire réponse admin --}}
    @if($ticket->statut !== 'cloture')
    <div class="card border-0 shadow-sm mb-4" style="border-radius:10px;">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-3">Répondre</h5>
            <form method="POST" action="{{ route('admin.tickets.reply', $ticket) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <textarea name="body" class="form-control @error('body') is-invalid @enderror"
                        rows="5" placeholder="Votre réponse..." required>{{ old('body') }}</textarea>
                    @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="no_char_limit" name="no_char_limit" value="1">
                    <label class="form-check-label small text-muted" for="no_char_limit">
                        Aucune limite de caractères pour le prochain message du client
                    </label>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark px-4">Envoyer la réponse</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Actions --}}
    <div class="d-flex flex-wrap gap-2">
        @if($ticket->statut === 'ouvert' || $ticket->statut === 'reouverture_demandee')
            <form method="POST" action="{{ route('admin.tickets.close', $ticket) }}"
                  onsubmit="return confirm('Clôturer ce ticket ?')">
                @csrf
                <button type="submit" class="btn btn-danger">Clôturer le ticket</button>
            </form>
        @endif

        @if($ticket->statut === 'reouverture_demandee')
            <form method="POST" action="{{ route('admin.tickets.accept-reopen', $ticket) }}"
                  onsubmit="return confirm('Accepter la réouverture ?')">
                @csrf
                <button type="submit" class="btn btn-success">Accepter la réouverture</button>
            </form>
            <form method="POST" action="{{ route('admin.tickets.deny-reopen', $ticket) }}"
                  onsubmit="return confirm('Refuser la réouverture ?')">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Refuser la réouverture</button>
            </form>
        @endif
    </div>

</div>
@endsection
