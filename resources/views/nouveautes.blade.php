@extends('layouts.app')

@section('title', __('messages.nav_news') . ' — PlanEx')
@section('meta_description', __('messages.seo_news_desc'))

@section('content')

<div class="container py-5" style="max-width:680px">
    <h1 class="mb-4">{{ __('messages.news_title') }}</h1>

    <div class="infos-content">
        <p class="lead">{{ __('messages.news_p1') }}</p>
        <p>{{ __('messages.news_p2') }}</p>
        <p>{{ __('messages.news_p3') }}</p>
        <p>{{ __('messages.news_p4') }}</p>
        <p class="mt-4 mb-0">{{ __('messages.news_signoff') }}<br><strong>{{ __('messages.news_team') }}</strong></p>
    </div>
</div>

@endsection
