<aside class="vt-sidebar vt-bg-surface border-end d-flex flex-column h-100 transition-all shadow-sm" style="width: 260px; min-height: calc(100vh - 72px);">
    <div class="p-3 flex-grow-1 overflow-y-auto">
        
        <div class="mb-4">
            <button class="btn vt-btn vt-btn-primary w-100 d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#createRoomModal">
                <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i> Create Room
            </button>
        </div>

        <div class="text-uppercase text-muted fw-bold small mb-2 px-3 letter-spacing-1">Host Controls</div>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('host.dashboard') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('host.dashboard') }}">
                    <i data-lucide="layout-dashboard" style="width: 18px; height: 18px;"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('host.rooms') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('host.rooms') }}">
                    <i data-lucide="radio" style="width: 18px; height: 18px;"></i> <span>Rooms</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('host.queue') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('host.queue') }}">
                    <i data-lucide="list-music" style="width: 18px; height: 18px;"></i> <span>Live Queue</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('host.songs') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('host.songs') }}">
                    <i data-lucide="music" style="width: 18px; height: 18px;"></i> <span>Songs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('host.voting') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('host.voting') }}">
                    <i data-lucide="thumbs-up" style="width: 18px; height: 18px;"></i> <span>Voting</span>
                </a>
            </li>
        </ul>

        <div class="text-uppercase text-muted fw-bold small mb-2 px-3 letter-spacing-1">Analytics</div>
        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('host.analytics') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('host.analytics') }}">
                    <i data-lucide="bar-chart-2" style="width: 18px; height: 18px;"></i> <span>Room Analytics</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
