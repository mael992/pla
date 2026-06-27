@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h2>{{ __('messages.user_edit_title') }}</h2>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <label>{{ __('messages.col_username') }}</label>
                <input type="text" name="username" value="{{ $user->username }}" required>
                @error('username') <span style="color:red">{{ $message }}</span> @enderror

                <br><br>

                <label>{{ __('messages.user_email_hint') }}</label>
                <input type="email" name="email" value="{{ $user->email }}">
                @error('email') <span style="color:red">{{ $message }}</span> @enderror

                <br><br>

                <label>{{ __('messages.user_password') }}</label>
                @if($user->role === 'admin')
                    <div style="color:gray;font-size:0.9rem;">{{ __('messages.user_reset_password_admin_note') }}</div>
                @else
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" name="reset_password" id="reset_password" value="1">
                        <label class="form-check-label" for="reset_password">{{ __('messages.user_reset_password') }}</label>
                    </div>
                    <small style="color:gray">{{ __('messages.user_reset_password_help') }}</small>
                @endif

                <br><br>

                <label>{{ __('messages.user_role') }}</label>
                <select name="role" required>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="incident" {{ $user->role == 'incident' ? 'selected' : '' }}>Incident</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>

                <br><br>

                <div class="card-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        {{ __('messages.btn_back') }}
                    </a>
                    <button type="submit" class="btn btn-warning">
                        {{ __('messages.user_save') }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
