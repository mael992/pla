@extends('layouts.app')

@section('styles')
<style>
.pricing-card {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 28px 20px 24px;
    text-align: center;
    background: #fff;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: transform .2s, box-shadow .2s;
}
.pricing-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(0,0,0,.12); }
.pricing-card--featured { border-color: #f59e0b; box-shadow: 0 4px 24px rgba(245,158,11,.25); }
.pricing-badge {
    display: inline-block;
    color: #fff;
    font-weight: 700;
    font-size: .85rem;
    letter-spacing: .06em;
    border-radius: 20px;
    padding: 4px 16px;
    margin-bottom: 12px;
}
.pricing-icon { font-size: 2.4rem; margin-bottom: 8px; }
.pricing-price-main {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1e293b;
    line-height: 1;
    margin-bottom: 4px;
}
.pricing-price-main span { font-size: 1rem; font-weight: 500; color: #64748b; }
.pricing-price-annual {
    font-size: .82rem;
    color: #64748b;
    margin-bottom: 16px;
}
.pricing-features { flex: 1; text-align: left; margin-bottom: 20px; }
.pricing-feature {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    padding: 6px 0;
    font-size: .88rem;
    border-bottom: 1px solid #f1f5f9;
}
.pricing-feature:last-child { border-bottom: none; }
.pf-icon { flex-shrink: 0; font-size: 1rem; }
.pf-no { opacity: .4; text-decoration: line-through; }
.pricing-btn {
    display: block;
    background: #1e293b;
    color: #fff;
    border-radius: 8px;
    padding: 10px 0;
    font-weight: 600;
    font-size: .9rem;
    text-decoration: none;
    transition: background .2s;
}
.pricing-btn:hover { background: #334155; color: #fff; }
.pricing-btn--gold { background: #f59e0b; }
.pricing-btn--gold:hover { background: #d97706; }
</style>
@endsection

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
                <div class="pricing-price-main">80€<span>/mois</span></div>
                <div class="pricing-price-annual">960€/an par personne</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span>{{ __('messages.pricing_persons') }} : <strong>1</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">💰</span>
                        <span>Facturation annuelle : <strong>960€/an</strong></span>
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

        {{-- SILVER --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="pricing-card">
                <div class="pricing-badge" style="background:#aaa">SILVER</div>
                <div class="pricing-icon">🥈</div>
                <div class="pricing-price-main">60€<span>/mois</span></div>
                <div class="pricing-price-annual">720€/an par personne</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span>{{ __('messages.pricing_persons') }} : <strong>2 à 10</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">💰</span>
                        <span>Facturation annuelle : <strong>1 440€ à 7 200€/an</strong></span>
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
                <div class="pricing-price-main">50€<span>/mois</span></div>
                <div class="pricing-price-annual">600€/an par personne</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span>{{ __('messages.pricing_persons') }} : <strong>11 à 20</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">💰</span>
                        <span>Facturation annuelle : <strong>7 200€ à 12 000€/an</strong></span>
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
                <div class="pricing-price-main">40€<span>/mois</span></div>
                <div class="pricing-price-annual">480€/an par personne</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span>{{ __('messages.pricing_persons') }} : <strong>&gt;21</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">💰</span>
                        <span>Facturation annuelle : <strong>10 080€/an</strong></span>
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

    </div>{{-- /row --}}

</div>
@endsection
