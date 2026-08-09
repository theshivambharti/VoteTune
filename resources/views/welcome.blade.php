<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="system">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VoteTune - The Modern Live Voting Experience</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero-section {
            position: relative;
            padding: 8rem 0 6rem;
            overflow: hidden;
            background-color: #000;
        }
        .hero-bg-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80vw;
            height: 80vw;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.25) 0%, rgba(0,0,0,0) 70%);
            z-index: 0;
            pointer-events: none;
        }
        .glass-mockup {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
        }
        .text-gradient {
            background: linear-gradient(135deg, #a5b4fc, #818cf8, #4f46e5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top bg-dark border-bottom border-dark" style="background: rgba(0,0,0,0.8) !important; backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-white fw-bold fs-4" href="/">
                <i data-lucide="music-4" class="text-primary" style="width: 28px; height: 28px;"></i> VoteTune
            </a>
            <div class="d-flex align-items-center gap-3 ms-auto">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn vt-btn vt-btn-primary px-4 rounded-pill">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-link text-white text-decoration-none px-3">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn vt-btn vt-btn-primary px-4 rounded-pill shadow-sm">Get Started</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center text-white flex-grow-1 d-flex align-items-center">
        <div class="hero-bg-glow"></div>
        <div class="container position-relative z-1 mt-5">
            <div class="row justify-content-center align-items-center g-5 text-start">
                
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill glass-card text-white-50 mb-4 small fw-semibold letter-spacing-1">
                        <span class="badge bg-primary rounded-pill">New</span> Real-time Laravel Reverb Support
                    </div>
                    <h1 class="display-3 fw-bolder mb-4 lh-1 text-white">
                        Let the crowd <br>
                        <span class="text-gradient">control the vibe.</span>
                    </h1>
                    <p class="fs-5 text-white-50 mb-5 pe-md-5">
                        Create rooms, manage the queue, and let your audience vote in real-time. The ultimate interactive polling platform built for modern events.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ route('register') }}" class="btn vt-btn vt-btn-primary btn-lg px-5 rounded-pill shadow-lg d-flex justify-content-center align-items-center gap-2">
                            Start for free <i data-lucide="arrow-right" style="width: 20px;"></i>
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-5 rounded-pill glass-card border-white-50">
                            See how it works
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="glass-mockup p-4 floating-element position-relative">
                        <!-- Decorative status bar -->
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary border-opacity-25">
                            <div class="d-flex align-items-center gap-2">
                                <span class="spinner-grow spinner-grow-sm text-success" role="status" style="width: 8px; height: 8px;"></span>
                                <span class="text-white-50 small fw-bold letter-spacing-1 text-uppercase">Live Room: FRIDAY</span>
                            </div>
                            <div class="text-white-50 small">1,204 connected</div>
                        </div>

                        <!-- Mock Live Voting -->
                        <div class="d-flex flex-column gap-3">
                            <!-- Track 1 -->
                            <div class="d-flex align-items-center p-3 rounded glass-card border-primary">
                                <img src="https://i.pravatar.cc/150?img=33" class="rounded" width="48" height="48" alt="Cover">
                                <div class="ms-3 me-auto">
                                    <h6 class="mb-0 text-white fw-bold">Midnight City</h6>
                                    <span class="text-white-50 small">M83</span>
                                </div>
                                <div class="text-end">
                                    <div class="text-primary fw-bold fs-5">428</div>
                                    <div class="text-primary small">votes</div>
                                </div>
                            </div>
                            <!-- Track 2 -->
                            <div class="d-flex align-items-center p-3 rounded glass-card">
                                <img src="https://i.pravatar.cc/150?img=12" class="rounded" width="48" height="48" alt="Cover">
                                <div class="ms-3 me-auto">
                                    <h6 class="mb-0 text-white fw-bold">Blinding Lights</h6>
                                    <span class="text-white-50 small">The Weeknd</span>
                                </div>
                                <div class="text-end">
                                    <div class="text-white-50 fw-bold fs-5">392</div>
                                    <div class="text-white-50 small">votes</div>
                                </div>
                            </div>
                            <!-- Track 3 -->
                            <div class="d-flex align-items-center p-3 rounded glass-card opacity-75">
                                <div class="bg-secondary bg-opacity-25 rounded d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                    <i data-lucide="music" class="text-white-50"></i>
                                </div>
                                <div class="ms-3 me-auto w-50">
                                    <div class="bg-secondary bg-opacity-25 rounded mb-2" style="height: 12px; width: 80%;"></div>
                                    <div class="bg-secondary bg-opacity-25 rounded" style="height: 10px; width: 40%;"></div>
                                </div>
                                <div class="text-end">
                                    <div class="bg-secondary bg-opacity-25 rounded mx-auto" style="height: 20px; width: 30px;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white-50 border-top border-secondary border-opacity-25">
        <div class="container text-center">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                <i data-lucide="music-4" style="width: 20px; height: 20px;" class="text-primary"></i>
                <span class="fw-bold fs-5 text-white">VoteTune</span>
            </div>
            <p class="mb-0 small">&copy; {{ date('Y') }} VoteTune. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
