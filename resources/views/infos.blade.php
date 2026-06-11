@extends('layouts.app')

@section('title', __('messages.infos_title') . ' — PlanEx')
@section('meta_description', __('messages.seo_infos_desc'))

@section('content')

<div class="container py-5" style="max-width: 760px;">

    <h1 class="mb-4">{{ __('messages.infos_title') }}</h1>

    <div class="infos-content">
        <p>{{ __('messages.infos_p1') }}</p>
        <p>{{ __('messages.infos_p2') }}</p>
        <p>{{ __('messages.infos_p3') }}</p>
        <p><strong>{{ __('messages.infos_p4') }}</strong></p>
    </div>

</div>

@endsection
