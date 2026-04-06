@extends('layouts.app')

@section('content')

<div class="container">

<h1>✏️ Modifier incident</h1>

<form method="POST" action="{{ route('incidents.update', $incident->id_incident) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<input type="date" name="date_incident" value="{{ $incident->date_incident }}"><br><br>

<input type="text" name="departement" value="{{ $incident->departement }}"><br><br>

<input type="text" name="systeme" value="{{ $incident->systeme }}"><br><br>

<input type="text" name="lot_travail" value="{{ $incident->lot_travail }}"><br><br>

<input type="text" name="zone" value="{{ $incident->zone }}"><br><br>

<input type="text" name="etiquette" value="{{ $incident->etiquette }}"><br><br>

<textarea name="description">{{ $incident->description }}</textarea><br><br>

<input type="text" name="categorie" value="{{ $incident->categorie }}"><br><br>

<input type="text" name="responsabilite" value="{{ $incident->responsabilite }}"><br><br>

<input type="text" name="emis_par" value="{{ $incident->emis_par }}"><br><br>

<select name="statut">
    <option value="en_attente" @selected($incident->statut=='en_attente')>En attente</option>
    <option value="valide" @selected($incident->statut=='valide')>Validé</option>
    <option value="refuse" @selected($incident->statut=='refuse')>Refusé</option>
</select><br><br>

@if($incident->photo)
    <img src="{{ asset('storage/'.$incident->photo) }}" width="120"><br><br>
@endif

<input type="file" name="photo"><br><br>

<button class="btn btn-warning">Mettre à jour</button>

</form>

</div>

@endsection