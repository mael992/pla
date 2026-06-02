@extends('layouts.app')

@section('content')

<div class="container-fluid px-3 px-md-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="h3 mb-0">{{ __('messages.users_title') }}</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            {{ __('messages.user_add') }}
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('messages.col_id') }}</th>
                        <th>{{ __('messages.col_username') }}</th>
                        <th>{{ __('messages.col_email') }}</th>
                        <th>{{ __('messages.col_role') }}</th>
                        <th class="text-end">{{ __('messages.col_actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="fw-semibold text-muted">{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email ?? '—' }}</td>
                        <td>
                            @php
                                $roleColors = ['admin' => 'danger', 'incident' => 'warning', 'user' => 'secondary'];
                                $color = $roleColors[$user->role] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">
                                ✏️ {{ __('messages.btn_edit') }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Aucun utilisateur.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
