@extends('layouts.app')

@section('title', __('messages.news_title') . ' — PlanEx')
@section('meta_description', __('messages.seo_news_desc'))

@section('content')

<div class="container py-5" style="max-width:600px">
    <h1>{{ __('messages.news_title') }}</h1>
    <p class="text-muted mt-2">{{ __('messages.news_coming_p1') }}</p>
    <p class="text-muted mt-2">{{ __('messages.news_coming_p2') }}</p>
</div>

@endsection
