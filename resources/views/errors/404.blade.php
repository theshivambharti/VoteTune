@extends('layouts.guest')
@section('title', 'Page Not Found - VoteTune')
@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 p-3 bg-body-tertiary">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-primary mb-0">404</h1>
        <h2 class="vt-h2 mb-4">Page Not Found</h2>
        <p class="text-muted mb-5">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <a href="{{ url('/') }}" class="btn vt-btn vt-btn-primary px-4">Return Home</a>
    </div>
</div>
@endsection
