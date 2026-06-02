@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 900px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ __('messages.incident_new') }}</h1>
        <a href="{{ route('incidents.index') }}" class="btn btn-outline-secondary">
            {{ __('messages.btn_back') }}
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('incidents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('partials.form')

                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('messages.incident_create_btn') }}</button>
                    <a href="{{ route('incidents.index') }}" class="btn btn-outline-secondary">{{ __('messages.btn_cancel') }}</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
