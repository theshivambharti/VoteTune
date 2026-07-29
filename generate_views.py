import os

views = {
    'resources/views/auth/login.blade.php': r"""@extends('layouts.guest')
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
""",
    'resources/views/auth/register.blade.php': r"""@extends('layouts.guest')
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
""",
    'resources/views/auth/forgot-password.blade.php': r"""@extends('layouts.guest')
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
"""
}

os.makedirs('resources/views/auth', exist_ok=True)
for path, content in views.items():
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
        
print("Auth views generated.")
