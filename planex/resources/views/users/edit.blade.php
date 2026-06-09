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

                <label>{{ __('messages.user_password_optional') }}</label>
                <input type="password" name="password" minlength="8">
                <small style="color:gray">{{ __('Minimum 8 caractères') }}</small>
                @error('password') <span style="color:red">{{ $message }}</span> @enderror

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
