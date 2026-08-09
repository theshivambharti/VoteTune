<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="system">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Host - {{ config('app.name', 'VoteTune') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    @include('partials.navbar')
    <div class="d-flex flex-grow-1">
        @include('partials.host-sidebar')
        <main class="flex-grow-1 p-4 w-100 overflow-hidden bg-body-tertiary">
            @yield('content')
        </main>
    </div>
    @include('partials.footer')
    <x-flash-message />
    @stack('scripts')
</body>
</html>