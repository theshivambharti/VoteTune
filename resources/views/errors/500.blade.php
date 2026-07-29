@extends('layouts.guest')
@section('content')
<div class="text-center">
    <div class="vt-display text-danger fw-bold mb-3">500</div>
    <h1 class="vt-h2 mb-3">Server Error</h1>
    <p class="text-secondary vt-body mb-4">Something went wrong on our end. We are investigating the issue.</p>
    <a href="{{ url('/') }}" class="btn vt-btn vt-btn-primary d-inline-flex align-items-center gap-2">
        <i data-lucide="refresh-cw" style="width: 18px;"></i> Try again
    </a>
</div>
@endsection