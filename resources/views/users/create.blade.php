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

                <label>{{ __('Prénom') }}</label>
                <input type="text" name="prenom" id="inputPrenom" value="{{ old('prenom') }}" required>
                @error('prenom') <span style="color:red">{{ $message }}</span> @enderror

                <br><br>

                <label>{{ __('Nom') }}</label>
                <input type="text" name="nom" id="inputNom" value="{{ old('nom') }}" required>
                @error('nom') <span style="color:red">{{ $message }}</span> @enderror

                <br><br>

                <div style="background:#f1f5f9;border-radius:6px;padding:8px 12px;font-size:14px">
                    {{ __('Identifiant généré') }} :
                    <strong id="usernamePreview" style="color:#1e293b">—</strong>
                    <small style="color:#64748b">{{ __('(+1 automatique si déjà pris)') }}</small>
                </div>

                <br>

                <label>{{ __('messages.user_email_hint') }}</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email') <span style="color:red">{{ $message }}</span> @enderror

                <br><br>

                <label>{{ __('messages.user_password') }}</label>
                <input type="password" name="password" required minlength="8">
                <small style="color:gray">{{ __('Minimum 8 caractères') }}</small>
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

<script>
(function () {
    const prenom  = document.getElementById('inputPrenom');
    const nom     = document.getElementById('inputNom');
    const preview = document.getElementById('usernamePreview');

    const cap = s => s ? s.charAt(0).toUpperCase() + s.slice(1) : '';

    function update() {
        const p = cap(prenom.value.trim());
        const n = cap(nom.value.trim());
        preview.textContent = (p && n) ? p + '.' + n : '—';
    }

    prenom.addEventListener('input', update);
    nom.addEventListener('input', update);
    update();
})();
</script>

@endsection
