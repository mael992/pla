@extends('layouts.app')

@section('content')

<div class="container">

<h1>➕ Créer un incident</h1>

<form method="POST" action="{{ route('incidents.store') }}" enctype="multipart/form-data">
@csrf

<input type="date" name="date_incident" required><br><br>

<input type="text" name="departement" placeholder="Département"><br><br>

<input type="text" name="systeme" placeholder="Système"><br><br>

<input type="text" name="lot_travail" placeholder="Lot de travail"><br><br>

<input type="text" name="zone" placeholder="Zone"><br><br>

<input type="text" name="etiquette" placeholder="Étiquette"><br><br>

<textarea name="description" placeholder="Description"></textarea><br><br>

<input type="text" name="categorie" placeholder="Catégorie"><br><br>

<input type="text" name="responsabilite" placeholder="Responsabilité"><br><br>

<input type="text" name="emis_par" placeholder="Émis par"><br><br>

<select name="statut">
    <option value="en_attente">En attente</option>
    <option value="valide">Validé</option>
    <option value="refuse">Refusé</option>
</select><br><br>

<input type="file" name="photo"><br><br>

<button class="btn btn-warning">Créer</button>

</form>

</div>

@endsection