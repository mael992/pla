@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h2>{{ __('messages.user_add_title') }}</h2>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <label>{{ __('messages.col_username') }}</label>
                <input type="text" name="username" value="{{ old('username') }}" required>
                @error('username') <span style="color:red">{{ $message }}</span> @enderror

                <br><br>

                <label>{{ __('messages.user_email_hint') }}</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email') <span style="color:red">{{ $message }}</span> @enderror

                <br><br>

                <label>{{ __('messages.user_password') }}</label>
                <input type="password" name="password" required>
                @error('password') <span style="color:red">{{ $message }}</span> @enderror

                <br><br>

                <label>{{ __('messages.user_role') }}</label>
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="incident">Incident</option>
                    <option value="admin">Admin</option>
                </select>

                <br><br>

                <div class="card-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        {{ __('messages.btn_back') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        {{ __('messages.user_create') }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
