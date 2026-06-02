@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h3 mb-0">{{ __('messages.chantiers_title') }}</h1>
        <a href="{{ route('chantiers.create') }}" class="btn btn-primary">
            {{ __('messages.chantier_new') }}
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('messages.col_id') }}</th>
                        <th>{{ __('messages.field_nom') }}</th>
                        <th>{{ __('messages.col_localite') }}</th>
                        <th class="text-center">{{ __('messages.col_incidents_count') }}</th>
                        <th class="text-end">{{ __('messages.col_actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($chantiers as $chantier)
                    <tr>
                        <td class="fw-semibold text-muted">{{ $chantier->id }}</td>
                        <td class="fw-semibold">{{ $chantier->nom }}</td>
                        <td>
                            <span class="text-muted">📍</span> {{ $chantier->localite }}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $chantier->incidents_count > 0 ? 'danger' : 'secondary' }}">
                                {{ $chantier->incidents_count }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('chantiers.show', $chantier) }}"
                                   class="btn btn-outline-secondary" title="Voir le tableau de bord">
                                    📊
                                </a>
                                <a href="{{ route('chantiers.edit', $chantier) }}"
                                   class="btn btn-outline-primary">
                                    ✏️ {{ __('messages.btn_edit') }}
                                </a>
                                <form action="{{ route('chantiers.destroy', $chantier) }}"
                                      method="POST"
                                      onsubmit="return confirm('{{ __('messages.chantier_deleted') }}')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">
                                        🗑 {{ __('messages.btn_delete') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            {{ __('messages.chantier_none') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
