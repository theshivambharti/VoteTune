<aside class="vt-sidebar vt-bg-surface border-end d-flex flex-column h-100 transition-all shadow-sm" style="width: 260px; min-height: calc(100vh - 72px);">
    <div class="p-3 flex-grow-1 overflow-y-auto">
        
        <div class="text-uppercase text-muted fw-bold small mb-2 px-3 mt-2 letter-spacing-1">Overview</div>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.dashboard') }}">
                    <i data-lucide="layout-dashboard" style="width: 18px; height: 18px;"></i> <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <div class="text-uppercase text-muted fw-bold small mb-2 px-3 letter-spacing-1">Management</div>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.users') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.users') }}">
                    <i data-lucide="users" style="width: 18px; height: 18px;"></i> <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.hosts') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.hosts') }}">
                    <i data-lucide="mic-2" style="width: 18px; height: 18px;"></i> <span>Hosts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.rooms') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.rooms') }}">
                    <i data-lucide="radio" style="width: 18px; height: 18px;"></i> <span>Rooms</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.songs') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.songs') }}">
                    <i data-lucide="music" style="width: 18px; height: 18px;"></i> <span>Songs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.votes') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.votes') }}">
                    <i data-lucide="thumbs-up" style="width: 18px; height: 18px;"></i> <span>Votes</span>
                </a>
            </li>
        </ul>

        <div class="text-uppercase text-muted fw-bold small mb-2 px-3 letter-spacing-1">Business</div>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.plans') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.plans') }}">
                    <i data-lucide="credit-card" style="width: 18px; height: 18px;"></i> <span>Plans</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.subscriptions') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.subscriptions') }}">
                    <i data-lucide="receipt" style="width: 18px; height: 18px;"></i> <span>Subscriptions</span>
                </a>
            </li>
        </ul>

        <div class="text-uppercase text-muted fw-bold small mb-2 px-3 letter-spacing-1">Analytics</div>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.reports') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.reports') }}">
                    <i data-lucide="bar-chart-2" style="width: 18px; height: 18px;"></i> <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.activity') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.activity') }}">
                    <i data-lucide="activity" style="width: 18px; height: 18px;"></i> <span>Activity</span>
                </a>
            </li>
        </ul>

        <div class="text-uppercase text-muted fw-bold small mb-2 px-3 letter-spacing-1">System</div>
        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.notifications') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.notifications') }}">
                    <i data-lucide="bell" style="width: 18px; height: 18px;"></i> <span>Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded fw-semibold {{ request()->routeIs('admin.settings') ? 'bg-primary bg-opacity-10 text-primary' : 'text-secondary hover-bg-light' }}" href="{{ route('admin.settings') }}">
                    <i data-lucide="settings" style="width: 18px; height: 18px;"></i> <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
