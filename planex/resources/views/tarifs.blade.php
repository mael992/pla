@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Alerte accès refusé --}}
    @if(session('upgrade'))
        <div class="alert alert-warning d-flex align-items-center gap-3 mb-4">
            <span style="font-size:1.5rem">🔒</span>
            <div>
                <strong>{{ __('messages.pricing_not_access') }}</strong>
            </div>
        </div>
    @endif

    {{-- En-tête --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-2">{{ __('messages.pricing_title') }}</h1>
        <p class="text-muted fs-5">{{ __('messages.pricing_subtitle') }}</p>
    </div>

    {{-- Grille des packs --}}
    <div class="row g-4 justify-content-center">

        {{-- BRONZE --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="pricing-card">
                <div class="pricing-badge" style="background:#cd7f32">BRONZE</div>
                <div class="pricing-icon">🥉</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span>{{ __('messages.pricing_persons') }} : <strong>1–5</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📋</span>
                        <span>{{ __('messages.pricing_access') }}</span>
                    </div>
                    <div class="pricing-feature pf-no">
                        <span class="pf-icon">🛠️</span>
                        <span>{{ __('messages.pricing_support') }}</span>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="pricing-btn">
                    {{ __('messages.pricing_contact_btn') }}
                </a>
            </div>
        </div>

        {{-- SILVER --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="pricing-card">
                <div class="pricing-badge" style="background:#aaa">SILVER</div>
                <div class="pricing-icon">🥈</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span>{{ __('messages.pricing_persons') }} : <strong>6–15</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📋</span>
                        <span>{{ __('messages.pricing_access') }}</span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">🛠️</span>
                        <span>{{ __('messages.pricing_support') }}</span>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="pricing-btn">
                    {{ __('messages.pricing_contact_btn') }}
                </a>
            </div>
        </div>

        {{-- GOLD --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="pricing-card pricing-card--featured">
                <div class="pricing-badge" style="background:#f59e0b">GOLD ⭐</div>
                <div class="pricing-icon">🥇</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span>{{ __('messages.pricing_persons') }} : <strong>16–30</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📋</span>
                        <span>{{ __('messages.pricing_access') }}</span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">🛠️</span>
                        <span>{{ __('messages.pricing_support') }}</span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📊</span>
                        <span>{{ __('messages.pricing_monthly') }} / {{ __('messages.pricing_annual') }}</span>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="pricing-btn pricing-btn--gold">
                    {{ __('messages.pricing_contact_btn') }}
                </a>
            </div>
        </div>

        {{-- PLATINUM --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="pricing-card">
                <div class="pricing-badge" style="background:#7c3aed">PLATINUM 💎</div>
                <div class="pricing-icon">💎</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span>{{ __('messages.pricing_persons') }} : <strong>30+</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📋</span>
                        <span>{{ __('messages.pricing_access') }}</span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">🛠️</span>
                        <span>{{ __('messages.pricing_support') }}</span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📊</span>
                        <span>{{ __('messages.pricing_monthly') }} / {{ __('messages.pricing_annual') }}</span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">✨</span>
                        <span>{{ __('messages.pricing_save') }}</span>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="pricing-btn">
                    {{ __('messages.pricing_contact_btn') }}
                </a>
            </div>
        </div>

    </div>{{-- /row --}}

    {{-- Note abonnement --}}
    <p class="text-center text-muted small mt-4">
        {{ __('messages.pricing_monthly') }} &amp; {{ __('messages.pricing_annual') }} —
        {{ __('messages.pricing_save') }}
    </p>

</div>
@endsection
