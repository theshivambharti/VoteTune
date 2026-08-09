@extends('layouts.guest')
@section('title', 'Login - VoteTune')
@section('content')
<div class="container-fluid p-0 vh-100 d-flex flex-column flex-md-row">
    
    <!-- Left Side: Visual Storytelling (Hidden on mobile) -->
    <div class="col-md-6 d-none d-md-flex flex-column justify-content-between p-5 bg-dark text-white position-relative overflow-hidden">
        <!-- Abstract Background -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, var(--bs-primary), #111827, #4f46e5); opacity: 0.9; z-index: 1;"></div>
        
        <!-- Decorative blobs -->
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="z-index: 2;">
            <div class="position-absolute bg-white rounded-circle blur-3xl opacity-10" style="width: 400px; height: 400px; top: -100px; left: -100px;"></div>
            <div class="position-absolute bg-primary rounded-circle blur-3xl opacity-25" style="width: 500px; height: 500px; bottom: -200px; right: -100px;"></div>
        </div>

        <div class="position-relative" style="z-index: 3;">
            <a href="/" class="text-white text-decoration-none d-flex align-items-center gap-2 fw-bold fs-4">
                <i data-lucide="music-4"></i> VoteTune
            </a>
        </div>
        
        <div class="position-relative" style="z-index: 3;">
            <h1 class="display-4 fw-bolder mb-3">Control the vibe.</h1>
            <p class="fs-5 text-white-50 mb-0" style="max-width: 400px;">
                Join the room, vote on your favorite tracks, and watch the playlist evolve in real-time.
            </p>
        </div>
        
        <div class="position-relative d-flex align-items-center gap-3" style="z-index: 3;">
            <div class="d-flex -space-x-2">
                <img src="https://i.pravatar.cc/100?img=1" class="rounded-circle border border-2 border-dark" width="40" height="40" alt="User">
                <img src="https://i.pravatar.cc/100?img=2" class="rounded-circle border border-2 border-dark" width="40" height="40" alt="User" style="margin-left: -10px;">
                <img src="https://i.pravatar.cc/100?img=3" class="rounded-circle border border-2 border-dark" width="40" height="40" alt="User" style="margin-left: -10px;">
            </div>
            <span class="text-white-50 small">Trusted by 10,000+ partygoers</span>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="col-12 col-md-6 d-flex align-items-center justify-content-center p-4 bg-body">
        <div class="w-100" style="max-width: 420px; animation: vtFadeIn 0.5s ease-out;">
            
            <!-- Mobile Brand (Visible only on mobile) -->
            <div class="d-md-none text-center mb-5">
                <a href="/" class="text-body text-decoration-none d-inline-flex align-items-center gap-2 fw-bold fs-2 text-gradient">
                    <i data-lucide="music-4"></i> VoteTune
                </a>
            </div>

            <div class="mb-5 text-center text-md-start">
                <h2 class="fw-bolder mb-2">Welcome back</h2>
                <p class="text-muted">Enter your details to access your account.</p>
            </div>

            <x-flash-message />

            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                @csrf
                <div class="mb-4">
                    <x-input type="email" name="email" label="Email Address" id="email" required autofocus placeholder="name@company.com" />
                </div>

                <div class="mb-4">
                    <x-input type="password" name="password" label="Password" id="password" required placeholder="••••••••" />
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <x-checkbox name="remember" id="remember" label="Remember me" />
                    <a href="{{ route('password.request') }}" class="small fw-semibold text-primary text-decoration-none">Forgot Password?</a>
                </div>

                <button type="submit" class="btn vt-btn vt-btn-primary w-100 py-3 mb-4 shadow-sm">
                    Sign in to VoteTune
                </button>
                
                <div class="position-relative text-center my-4">
                    <hr class="text-muted opacity-25">
                    <span class="position-absolute top-50 start-50 translate-middle px-3 bg-body small text-muted text-uppercase letter-spacing-1">or continue with</span>
                </div>
                
                <a href="{{ route('social.redirect', 'google') }}" class="btn btn-light border w-100 py-3 d-flex align-items-center justify-content-center gap-2 hover-lift transition-all fw-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
                    Google
                </a>
            </form>

            <div class="text-center mt-5">
                <p class="text-muted mb-0">Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none ms-1">Sign up for free</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
