<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PlanEx')</title>
    <meta name="description" content="@yield('meta_description', __('messages.meta_default'))">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}?v=1" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ asset('favicon-180.png') }}?v=1">

    {{-- Open Graph (partage réseaux sociaux) --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PlanEx">
    <meta property="og:title" content="@yield('title', 'PlanEx')">
    <meta property="og:description" content="@yield('meta_description', __('messages.meta_default'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/Planex.jpg') }}">

    {{-- Données structurées : site + navigation (aide aux sitelinks Google) --}}
    @php
        $ldWebsite = [
            '@context' => 'https://schema.org',
            '@type'    => 'WebSite',
            'name'     => 'PlanEx',
            'url'      => url('/'),
        ];
        $ldNav = [
            '@context' => 'https://schema.org',
            '@type'    => 'SiteNavigationElement',
            'name'     => [__('messages.nav_home'), __('messages.nav_infos'), __('messages.nav_news'), __('messages.nav_contact')],
            'url'      => [route('home'), route('infos'), route('nouveautes'), route('contact')],
        ];
        $ldFlags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
    @endphp
    <script type="application/ld+json">{!! json_encode($ldWebsite, $ldFlags) !!}</script>
    <script type="application/ld+json">{!! json_encode($ldNav, $ldFlags) !!}</script>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Flag Icons (drapeaux SVG fiables) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.3/css/flag-icons.min.css">
    <!-- Styles personnalisés (après Bootstrap pour surcharger) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>

@include('partials.navbar')

<main>
    @yield('content')
</main>

@include('partials.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
