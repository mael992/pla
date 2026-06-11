@extends('layouts.app')

@section('title', __('messages.home_title'))
@section('meta_description', __('messages.seo_home_desc'))

@section('content')

<div class="home-container">
    <div class="home-title">
        <div align="center">
            <h1>{{ __('messages.home_title') }}</h1>
        </div>
    </div>
</div>

@endsection
