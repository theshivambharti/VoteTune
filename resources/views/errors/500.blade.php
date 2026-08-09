@extends('layouts.guest')
@section('title', 'Server Error - VoteTune')
@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 p-3 bg-body-tertiary">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-danger mb-0">500</h1>
        <h2 class="vt-h2 mb-4">Internal Server Error</h2>
        <p class="text-muted mb-5">Something went wrong on our end. We are currently trying to fix the problem.</p>
        <a href="{{ url('/') }}" class="btn vt-btn vt-btn-primary px-4">Return Home</a>
    </div>
</div>
@endsection
