<aside class="vt-sidebar vt-bg-surface border-end d-flex flex-column h-100 transition-all shadow-sm" style="width: 260px; min-height: calc(100vh - 72px);">
    <div class="p-3 flex-grow-1 overflow-y-auto">
        
        <div class="mb-4">
            <button class="btn vt-btn vt-btn-primary w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#joinRoomModal">
                <i data-lucide="log-in" style="width: 18px; height: 18px;"></i> Join Room
            </button>
        </div>

        <div class="text-uppercase text-muted fw-bold small mb-2 px-3 letter-spacing-1">Activity</div>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('user.dashboard') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('user.dashboard') }}">
                    <i data-lucide="layout-dashboard" style="width: 18px; height: 18px;"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('user.rooms') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('user.rooms') }}">
                    <i data-lucide="radio" style="width: 18px; height: 18px;"></i> <span>Recent Rooms</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('user.history') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('user.history') }}">
                    <i data-lucide="history" style="width: 18px; height: 18px;"></i> <span>Voting History</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
