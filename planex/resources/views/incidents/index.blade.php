@extends('layouts.app')

@section('content')

    <div class="page-header">

        <div class="page-title">
            📊 Liste des incidents
        </div>

        <div class="page-actions">
            <a href="{{ route('incidents.create') }}" class="btn-add">
                ➕ Ajouter un incident
            </a>
        </div>

    </div>

    <table class="table">

        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Département</th>
            <th>Système</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>

        @foreach($incidents as $incident)
        <tr>
            <td>{{ $incident->id_incident }}</td>
            <td>{{ $incident->date_incident }}</td>
            <td>{{ $incident->departement }}</td>
            <td>{{ $incident->systeme }}</td>
            <td>
                <span class="badge {{ $incident->statut }}">
                    {{ $incident->statut }}
                </span>
            </td>

            <td>
                <a href="{{ route('incidents.show', $incident->id_incident) }}" class="btn btn-secondary">
                    Voir
                </a>

                <a href="{{ route('incidents.edit', $incident->id_incident) }}" class="btn btn-warning">
                    Modifier
                </a>

                <form action="{{ route('incidents.destroy', $incident->id_incident) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

    {{ $incidents->links() }}

</div>

@endsection