@extends('layouts.guest')
@section('title', 'Login - VoteTune')
@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 p-3">
    <x-card class="vt-glass shadow-sm border-0 w-100" style="max-width: 420px; animation: vtFadeIn 0.5s ease-out;">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <h1 class="vt-h2 fw-bold text-gradient mb-2">VoteTune</h1>
                <p class="vt-body-medium text-muted">Welcome back! Please login to your account.</p>
            </div>

            <x-flash-message />

            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <x-input type="email" name="email" label="Email Address" id="email" required autofocus />
                </div>

                <div class="mb-3">
                    <x-input type="password" name="password" label="Password" id="password" required />
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <x-checkbox name="remember" id="remember" label="Remember me" />
                    <a href="{{ route('password.request') }}" class="vt-body-small text-decoration-none">Forgot Password?</a>
                </div>

                <x-button type="submit" variant="primary" class="w-100 mb-3 py-2">
                    Log In
                </x-button>
                
                <div class="text-center position-relative my-4">
                    <hr class="text-muted">
                    <span class="position-absolute top-50 start-50 translate-middle px-2 vt-bg vt-body-small text-muted">OR</span>
                </div>
                
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('social.redirect', 'google') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center py-2 w-100">
                        <i data-lucide="chrome" class="me-2" style="width: 18px; height: 18px;"></i> Continue with Google
                    </a>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="vt-body-small text-muted mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Sign up</a></p>
            </div>
        </div>
    </x-card>
</div>
@endsection
