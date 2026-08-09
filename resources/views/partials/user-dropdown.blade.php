@auth
<div class="dropdown">
    <button class="btn btn-link p-0 border-0 shadow-none position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <x-avatar initials="{{ substr(auth()->user()->name, 0, 1) }}" size="36px" />
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 vt-card mt-2" style="width: 200px;">
        <li class="px-3 py-2 border-bottom mb-1">
            <div class="fw-bold">{{ auth()->user()->name }}</div>
            <div class="vt-body-small text-secondary text-truncate">{{ auth()->user()->email }}</div>
        </li>
        <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.edit') }}"><i data-lucide="user" style="width: 16px;"></i> Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2 w-100 text-start border-0 bg-transparent">
                    <i data-lucide="log-out" style="width: 16px;"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
@endauth