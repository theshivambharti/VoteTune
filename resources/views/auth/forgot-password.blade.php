@extends('layouts.guest')
@section('title', 'Forgot Password - VoteTune')
@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 p-3">
    <x-card class="vt-glass shadow-sm border-0 w-100" style="max-width: 420px; animation: vtFadeIn 0.5s ease-out;">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle" style="width: 64px; height: 64px;">
                    <i data-lucide="key" style="width: 32px; height: 32px;"></i>
                </div>
                <h1 class="vt-h3 fw-bold mb-2">Reset Password</h1>
                <p class="vt-body-medium text-muted">Enter your email address and we'll send you a link to reset your password.</p>
            </div>

            <x-flash-message />

            <form method="POST" action="#" class="needs-validation" novalidate>
                @csrf
                <div class="mb-4">
                    <x-input type="email" name="email" label="Email Address" id="email" required autofocus />
                </div>

                <x-button type="submit" variant="primary" class="w-100 mb-3 py-2">
                    Send Reset Link
                </x-button>
            </form>
            
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold vt-body-small d-inline-flex align-items-center">
                    <i data-lucide="arrow-left" class="me-1" style="width: 14px; height: 14px;"></i> Back to Login
                </a>
            </div>
        </div>
    </x-card>
</div>
@endsection
