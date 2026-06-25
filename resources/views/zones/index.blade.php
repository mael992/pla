@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 600px;">

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ __('messages.zones_title') }}</h1>
        <a href="{{ route('incidents.index') }}" class="btn btn-outline-secondary">
            {{ __('messages.btn_back') }}
        </a>
    </div>

    {{-- Formulaire ajout --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">{{ __('messages.zone_add_section') }}</div>
        <div class="card-body">
            <form action="{{ route('zones.store') }}" method="POST">
                @csrf
                <div class="d-flex gap-2">
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="{{ __('messages.zone_name') }}"
                           value="{{ old('name') }}">
                    <button type="submit" class="btn btn-primary" style="white-space:nowrap">
                        {{ __('messages.btn_add') }}
                    </button>
                </div>
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>

    {{-- Liste --}}
    <div class="card shadow-sm">
        <div class="card-header">{{ __('messages.zone_existing') }}</div>
        <ul class="list-group list-group-flush">
            @forelse($zones as $zone)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $zone->name }}</span>
                @if(auth()->user() && auth()->user()->isAdmin())
                <form action="{{ route('zones.destroy', $zone->id) }}"
                      method="POST"
                      onsubmit="return confirm('{{ __('messages.zone_confirm_delete', ['name' => $zone->name]) }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        {{ __('messages.btn_delete') }}
                    </button>
                </form>
                @endif
            </li>
            @empty
            <li class="list-group-item text-muted text-center py-4">
                {{ __('messages.zone_none') }}
            </li>
            @endforelse
        </ul>
    </div>

</div>
@endsection
