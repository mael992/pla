@extends('layouts.app')

@section('title', 'Ticket expiré — PlanEx')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 text-center">
            <div class="card border-0 shadow-sm p-5" style="border-radius:12px;">
                <div style="font-size:3rem;" class="mb-3">&#128683;</div>
                <h2 class="fw-bold mb-2" style="font-size:1.3rem;">Ticket expiré</h2>
                <p class="text-muted mb-4">
                    Ce ticket a expiré et a été définitivement supprimé.<br>
                    Si vous avez encore besoin d'aide, vous pouvez soumettre un nouveau ticket.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-dark px-4">
                    Contacter le support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
