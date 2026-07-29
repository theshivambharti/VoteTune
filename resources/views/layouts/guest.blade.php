<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="system">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'VoteTune') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 vt-bg">
    
    <div class="position-absolute top-0 end-0 p-4">
        @include('partials.theme-switcher')
    </div>

    <main class="w-100" style="max-width: 450px; padding: 1rem;">
        <div class="text-center mb-4">
            <a href="/" class="text-decoration-none d-inline-flex align-items-center gap-2 vt-text-primary vt-h2">
                <i data-lucide="music-4" style="width: 32px; height: 32px;"></i> VoteTune
            </a>
        </div>
        
        @yield('content')
    </main>

    @include('partials.flash-message')
    @stack('scripts')
</body>
</html>