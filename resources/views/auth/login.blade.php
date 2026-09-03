@extends('layouts.guest')
@section('title', 'Login - VoteTune')
@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light p-3 p-md-4">
    
    <div class="card border-0 shadow-lg w-100 overflow-hidden" style="max-width: 1000px; border-radius: 1rem;">
        <div class="row g-0">
            <!-- Left Side: Visual Storytelling (Hidden on mobile) -->
            <div class="col-md-5 d-none d-md-flex flex-column justify-content-between p-4 p-lg-5 bg-dark text-white position-relative">
                <!-- Abstract Background -->
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, var(--bs-primary), #111827, #4f46e5); opacity: 0.9; z-index: 1;"></div>
                
                <!-- Decorative blobs -->
                <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="z-index: 2;">
                    <div class="position-absolute bg-white rounded-circle opacity-10" style="width: 400px; height: 400px; top: -100px; left: -100px; filter: blur(60px);"></div>
                    <div class="position-absolute bg-primary rounded-circle opacity-25" style="width: 500px; height: 500px; bottom: -200px; right: -100px; filter: blur(60px);"></div>
                </div>

                <div class="position-relative" style="z-index: 3;">
                    <a href="/" class="text-white text-decoration-none d-inline-flex align-items-center gap-2 fw-bold fs-4">
                        <i data-lucide="music-4"></i> VoteTune
                    </a>
                </div>
                
                <!-- Pushing text to the bottom area to remove massive white space at top -->
                <div class="position-relative mt-auto pt-5" style="z-index: 3;">
                    <h1 class="display-5 fw-bolder mb-3">Control the vibe.</h1>
                    <p class="fs-6 text-white-50 mb-5">
                        Join the room, vote on your favorite tracks, and watch the playlist evolve in real-time.
                    </p>
                    
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="d-flex" style="margin-left: 10px;">
                            <img src="https://i.pravatar.cc/100?img=1" class="rounded-circle border border-2 border-dark position-relative" width="40" height="40" alt="User" style="margin-left: -10px; z-index: 3;">
                            <img src="https://i.pravatar.cc/100?img=2" class="rounded-circle border border-2 border-dark position-relative" width="40" height="40" alt="User" style="margin-left: -10px; z-index: 2;">
                            <img src="https://i.pravatar.cc/100?img=3" class="rounded-circle border border-2 border-dark position-relative" width="40" height="40" alt="User" style="margin-left: -10px; z-index: 1;">
                        </div>
                        <span class="text-white-50 small m-0 text-wrap">Trusted by 10,000+ partygoers</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Login Form -->
            <div class="col-12 col-md-7 d-flex align-items-center justify-content-center p-4 p-md-5 bg-white">
                <div class="w-100" style="max-width: 420px; animation: vtFadeIn 0.5s ease-out;">
                    
                    <!-- Mobile Brand (Visible only on mobile) -->
                    <div class="d-md-none text-center mb-5">
                        <a href="/" class="text-body text-decoration-none d-inline-flex align-items-center gap-2 fw-bold fs-2 text-gradient">
                            <i data-lucide="music-4"></i> VoteTune
                        </a>
                    </div>

                    <div class="mb-4 text-center text-md-start">
                        <h2 class="fw-bolder mb-2">Welcome back</h2>
                        <p class="text-muted">Enter your details to access your account.</p>
                    </div>

                    <x-flash-message />

                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <x-input type="email" name="email" label="Email Address" id="email" required autofocus placeholder="name@company.com" />
                        </div>

                        <div class="mb-3">
                            <x-input type="password" name="password" label="Password" id="password" required placeholder="••••••••" />
                        </div>

                        <!-- Fixed alignment and wrap for small screens -->
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                            <div class="m-0 p-0">
                                <x-checkbox name="remember" id="remember" label="Remember me" class="m-0" />
                            </div>
                            <a href="{{ route('password.request') }}" class="small fw-semibold text-primary text-decoration-none text-nowrap">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn vt-btn vt-btn-primary w-100 py-2 py-md-3 mb-4 shadow-sm fw-bold fs-6">
                            Sign in to VoteTune
                        </button>
                        
                        <div class="position-relative text-center my-4">
                            <hr class="text-muted opacity-25">
                            <span class="position-absolute top-50 start-50 translate-middle px-3 bg-white small text-muted text-uppercase" style="letter-spacing: 1px;">or continue with</span>
                        </div>
                        
                        <a href="{{ route('social.redirect', 'google') }}" class="btn btn-light border w-100 py-2 py-md-3 d-flex align-items-center justify-content-center gap-2 hover-lift transition-all fw-semibold text-dark text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
                            Google
                        </a>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none ms-1">Sign up for free</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
