<nav class="navbar navbar-expand-lg vt-bg-surface vt-border-bottom sticky-top py-3">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold vt-text-primary" href="{{ url('/') }}">
            <i data-lucide="music-4"></i> VoteTune
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <i data-lucide="menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                @include('partials.theme-switcher')
                @include('partials.user-dropdown')
            </div>
        </div>
    </div>
</nav>