@extends('layouts.app')

@section('content')

<div class="container">

<h1>🔍 Détails incident</h1>

<div class="card">

    <div class="card-header">
        Incident #{{ $incident->id_incident }}
    </div>

    <div class="card-body">

        <p><strong>Date :</strong> {{ $incident->date_incident }}</p>
        <p><strong>Département :</strong> {{ $incident->departement }}</p>
        <p><strong>Système :</strong> {{ $incident->systeme }}</p>
        <p><strong>Description :</strong> {{ $incident->description }}</p>
        <p><strong>Statut :</strong> {{ $incident->statut }}</p>

        @if($incident->photo)
            <img src="{{ asset('storage/'.$incident->photo) }}" width="200">
        @endif

    </div>

    <div class="card-footer">

        <a href="{{ route('incidents.edit', $incident->id_incident) }}" class="btn btn-warning">
            Modifier
        </a>

        <a href="{{ route('incidents.index') }}" class="btn btn-secondary">
            Retour
        </a>

    </div>

</div>

</div>

@endsection