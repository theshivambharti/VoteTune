@extends('layouts.guest')
@section('content')
<div class="text-center">
    <div class="vt-display text-primary fw-bold mb-3">404</div>
    <h1 class="vt-h2 mb-3">Page not found</h1>
    <p class="text-secondary vt-body mb-4">Sorry, we couldn't find the page you're looking for. It might have been removed or the link is broken.</p>
    <a href="{{ url('/') }}" class="btn vt-btn vt-btn-primary d-inline-flex align-items-center gap-2">
        <i data-lucide="arrow-left" style="width: 18px;"></i> Go back home
    </a>
</div>
@endsection