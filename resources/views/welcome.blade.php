<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="system">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VoteTune - Make Every Vote Count</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-section {
            padding: 6rem 0 4rem;
            background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, transparent 100%);
        }
        .feature-icon-wrapper {
            width: 64px;
            height: 64px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(var(--bs-primary-rgb), 0.1);
            color: var(--bs-primary);
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 vt-bg">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top bg-body-tertiary border-bottom py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 vt-text-primary fw-bold fs-4" href="/">
                <i data-lucide="music-4" style="width: 28px; height: 28px;"></i> VoteTune
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i data-lucide="menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="#trust">Security</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    @include('partials.theme-switcher')
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn vt-btn vt-btn-primary px-4">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary px-4">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn vt-btn vt-btn-primary px-4">Sign up</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center px-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <h1 class="display-4 fw-bold mb-4">Make Every Vote Count.</h1>
                    <p class="lead text-muted mb-5 px-md-5">
                        Create, share, and manage modern digital polls with confidence. VoteTune brings real-time interactions to your audience, securely and beautifully.
                    </p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn vt-btn vt-btn-primary btn-lg px-5">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn vt-btn vt-btn-primary btn-lg px-5">Get Started</a>
                        @endauth
                        <a href="#features" class="btn btn-outline-secondary btn-lg px-5">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-body-tertiary">
        <div class="container py-5">
            <div class="text-center mb-5 pb-3">
                <h2 class="vt-h2">Designed for Modern Polling</h2>
                <p class="text-muted">Everything you need to host real-time votes.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <x-card class="h-100 border-0 shadow-sm hover-lift transition-all">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrapper">
                                <i data-lucide="zap" style="width: 32px; height: 32px;"></i>
                            </div>
                            <h4 class="vt-h4 mb-3">Real-time Updates</h4>
                            <p class="text-muted mb-0">Powered by Laravel Reverb, watch the votes roll in live without ever refreshing the page.</p>
                        </div>
                    </x-card>
                </div>
                <div class="col-md-4">
                    <x-card class="h-100 border-0 shadow-sm hover-lift transition-all">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrapper">
                                <i data-lucide="shield-check" style="width: 32px; height: 32px;"></i>
                            </div>
                            <h4 class="vt-h4 mb-3">Secure Voting</h4>
                            <p class="text-muted mb-0">Pessimistic database locking and strict session identity validation ensure one person, one vote.</p>
                        </div>
                    </x-card>
                </div>
                <div class="col-md-4">
                    <x-card class="h-100 border-0 shadow-sm hover-lift transition-all">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrapper">
                                <i data-lucide="layout-dashboard" style="width: 32px; height: 32px;"></i>
                            </div>
                            <h4 class="vt-h4 mb-3">Host Management</h4>
                            <p class="text-muted mb-0">Easily curate your rooms, manage songs, and toggle room status with a clean, responsive dashboard.</p>
                        </div>
                    </x-card>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust / Security Section -->
    <section id="trust" class="py-5 border-top border-bottom">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <i data-lucide="lock" class="text-primary mb-4" style="width: 48px; height: 48px;"></i>
                    <h2 class="vt-h2 mb-4">Trust in Every Tap</h2>
                    <p class="lead text-muted mb-0">
                        VoteTune is built on Enterprise-grade Laravel architecture. We never expose API secrets, we strictly enforce rate-limiting against automated abuse, and our voting logic is protected by transactional database locks.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="mt-auto py-4 bg-body-tertiary border-top">
        <div class="container text-center text-muted">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                <i data-lucide="music-4" style="width: 20px; height: 20px;" class="vt-text-primary"></i>
                <span class="fw-bold fs-5">VoteTune</span>
            </div>
            <p class="mb-0 small">&copy; {{ date('Y') }} VoteTune. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
