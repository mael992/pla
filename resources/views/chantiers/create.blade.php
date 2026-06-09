@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width:600px">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ __('messages.chantier_add_title') }}</h1>
        <a href="{{ route('chantiers.index') }}" class="btn btn-outline-secondary btn-sm">
            {{ __('messages.btn_back') }}
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('chantiers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">{{ __('messages.field_nom') }} <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom') }}" required autofocus>
                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">{{ __('messages.field_localite') }} <span class="text-danger">*</span></label>
                    <input type="text" name="localite" class="form-control @error('localite') is-invalid @enderror"
                           value="{{ old('localite') }}" required>
                    @error('localite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        💾 {{ __('messages.btn_create') }}
                    </button>
                    <a href="{{ route('chantiers.index') }}" class="btn btn-outline-secondary">
                        {{ __('messages.btn_cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
