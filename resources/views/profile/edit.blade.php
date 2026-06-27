@extends('layouts.app')

@section('title', __('messages.account_title') . ' — PlanEx')

@section('content')
<div class="container py-5" style="max-width: 640px;">

    <h1 class="mb-4">{{ __('messages.account_title') }}</h1>

    {{-- ── Identifiants (lecture seule) ───────────────────────── --}}
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="h5 mb-3">{{ __('messages.account_identity') }}</h2>
            <dl class="row mb-2">
                <dt class="col-sm-5">{{ __('messages.account_username') }}</dt>
                <dd class="col-sm-7">{{ auth()->user()->username }}</dd>
                <dt class="col-sm-5">{{ __('messages.account_role') }}</dt>
                <dd class="col-sm-7">{{ ucfirst(auth()->user()->role) }}</dd>
            </dl>
            <p class="text-muted small mb-0">{{ __('messages.account_username_help') }}</p>
        </div>
    </div>

    {{-- ── Adresse e-mail ─────────────────────────────────────── --}}
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="h5 mb-3">{{ __('messages.account_email_title') }}</h2>

            @if(session('status') === 'profile-updated')
                <div class="alert alert-success py-2">{{ __('messages.account_email_updated') }}</div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" novalidate>
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('messages.account_email_label') }} <span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" required
                           value="{{ old('email', auth()->user()->email) }}"
                           class="form-control @error('email') is-invalid @enderror"
                           autocomplete="email">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">{{ __('messages.account_email_help') }}</div>
                </div>

                <div class="mb-3">
                    <label for="current_password" class="form-label">{{ __('messages.account_current_password') }}</label>
                    <input type="password" id="current_password" name="current_password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           autocomplete="current-password">
                    @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">{{ __('messages.account_current_password_help') }}</div>
                </div>

                <button type="submit" class="btn btn-danger">{{ __('messages.account_save') }}</button>
            </form>
        </div>
    </div>

    {{-- ── Mot de passe ───────────────────────────────────────── --}}
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="h5 mb-3">{{ __('messages.account_pwd_title') }}</h2>

            @if(session('status') === 'password-updated')
                <div class="alert alert-success py-2">{{ __('messages.account_pwd_updated') }}</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="pwd_current" class="form-label">{{ __('messages.account_current_password') }}</label>
                    <input type="password" id="pwd_current" name="current_password"
                           class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                           autocomplete="current-password">
                    @error('current_password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('messages.account_new_password') }}</label>
                    <input type="password" id="password" name="password"
                           class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                           autocomplete="new-password">
                    @error('password', 'updatePassword')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('messages.account_confirm_password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-control" autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-danger">{{ __('messages.account_pwd_change') }}</button>
            </form>
        </div>
    </div>

</div>
@endsection
