@extends('layouts.guest')
@section('title', 'Register - VoteTune')
@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 p-3">
    <x-card class="vt-glass shadow-sm border-0 w-100" style="max-width: 480px; animation: vtFadeIn 0.5s ease-out;">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <h1 class="vt-h2 fw-bold text-gradient mb-2">Create Account</h1>
                <p class="vt-body-medium text-muted">Join VoteTune and start engaging.</p>
            </div>

            <x-flash-message />

            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                @csrf
                
                <div class="mb-3">
                    <x-input type="text" name="name" label="Full Name" id="name" required autofocus />
                </div>

                <div class="mb-3">
                    <x-input type="email" name="email" label="Email Address" id="email" required />
                </div>

                <div class="mb-3">
                    <x-input type="password" name="password" label="Password" id="password" required />
                </div>
                
                <div class="mb-4">
                    <x-input type="password" name="password_confirmation" label="Confirm Password" id="password_confirmation" required />
                </div>

                <x-button type="submit" variant="primary" class="w-100 py-2">
                    Create Account
                </x-button>
            </form>

            <div class="text-center mt-4">
                <p class="vt-body-small text-muted mb-0">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Log in</a></p>
            </div>
        </div>
    </x-card>
</div>
@endsection
