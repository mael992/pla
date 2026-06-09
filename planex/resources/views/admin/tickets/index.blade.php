@extends('layouts.app')

@section('title', 'Messages — Admin PlanEx')

@section('content')
<div class="container py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="fw-bold mb-0" style="font-size:1.4rem;">Tickets de support</h2>
        <span class="badge bg-secondary">{{ $tickets->count() }} ticket(s)</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($tickets->isEmpty())
        <div class="text-center text-muted py-5">
            <p style="font-size:1.1rem;">Aucun ticket pour le moment.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle border rounded" style="background:white;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th style="width:40px;" class="text-center">État</th>
                        <th style="width:100px;">N°</th>
                        <th>Sujet</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <td class="text-center">
                            @if($ticket->statut === 'cloture')
                                <span title="Clôturé" style="color:#6c757d;font-size:1.1rem;">&#9632;</span>
                            @else
                                <span title="Ouvert" style="color:#28a745;font-size:1.1rem;">&#9633;</span>
                            @endif
                        </td>
                        <td class="fw-semibold text-muted small">{{ $ticket->numero }}</td>
                        <td>
                            @if($ticket->statut === 'reouverture_demandee')
                                <span title="Réouverture demandée" class="me-1">&#9888;</span>
                            @endif
                            {{ $ticket->question_1 }}
                            <div class="text-muted" style="font-size:0.82rem;">{{ $ticket->question_2 }}</div>
                        </td>
                        <td class="small text-muted">{{ $ticket->email }}</td>
                        <td>
                            @if($ticket->statut === 'ouvert')
                                <span class="badge bg-success">Ouvert</span>
                            @elseif($ticket->statut === 'cloture')
                                <span class="badge bg-secondary">Clôturé</span>
                            @elseif($ticket->statut === 'reouverture_demandee')
                                <span class="badge bg-warning text-dark">Réouverture demandée</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-dark">Voir</a>
                                @if($ticket->statut !== 'cloture')
                                    <form method="POST" action="{{ route('admin.tickets.close', $ticket) }}"
                                          onsubmit="return confirm('Clôturer ce ticket ?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Clôturer</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
