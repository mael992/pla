@extends('layouts.app')

@section('title', __('messages.home_title'))
@section('meta_description', __('messages.seo_home_desc'))

@section('styles')
<style>
.px-hero {
    max-width: 1080px;
    margin: 0 auto;
    padding: 48px 16px 64px;
    text-align: center;
}
.px-hero-title {
    font-size: clamp(1.6rem, 4vw, 2.6rem);
    font-weight: 800;
    line-height: 1.15;
    margin: 0 auto 28px;
    max-width: 720px;
    letter-spacing: -0.5px;
}
.px-hero-media {
    position: relative;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 18px 50px rgba(0,0,0,.28);
}
.px-hero-img {
    display: block;
    width: 100%;
    height: auto;
}
/* Affichage de secours si la banniere n'est pas encore presente */
.px-hero-fallback {
    aspect-ratio: 16 / 9;
    background: linear-gradient(135deg, #1f2430 0%, #11141c 100%);
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 18px;
    padding: 24px;
}
.px-fb-logo {
    font-size: clamp(2rem, 6vw, 3.4rem);
    font-weight: 800;
    letter-spacing: 1px;
}
.px-fb-logo span { color: #ef4444; }
.px-fb-slogan {
    font-size: clamp(1rem, 2.6vw, 1.5rem);
    font-weight: 600;
    max-width: 560px;
    margin: 0;
}
.px-fb-feats {
    display: flex;
    flex-wrap: wrap;
    gap: 14px 28px;
    justify-content: center;
    font-size: .95rem;
}
.px-fb-feats span { display: inline-flex; align-items: center; gap: 8px; opacity: .9; }
.px-fb-feats b { color: #ef4444; font-size: 1.1rem; line-height: 1; }
</style>
@endsection

@section('content')
@php
    $hasHero = file_exists(public_path('images/accueil.jpg'));
@endphp

<section class="px-hero">

    <h1 class="px-hero-title">{{ __('messages.home_title') }}</h1>

    <div class="px-hero-media">
        @if($hasHero)
            <img src="{{ asset('images/accueil.jpg') }}" alt="{{ __('messages.home_hero_alt') }}" class="px-hero-img">
        @else
            <div class="px-hero-fallback">
                <div class="px-fb-logo">Plan<span>Ex</span></div>
                <p class="px-fb-slogan">{{ __('messages.home_banner_slogan') }}</p>
                <div class="px-fb-feats">
                    <span><b>‖</b> {{ __('messages.home_feature_1') }}</span>
                    <span><b>✓</b> {{ __('messages.home_feature_2') }}</span>
                </div>
            </div>
        @endif
    </div>

</section>
@endsection
