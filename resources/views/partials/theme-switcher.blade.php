<div class="dropdown">
    <button class="btn btn-link text-secondary p-0 border-0 shadow-none d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i data-lucide="moon" class="d-none theme-icon-dark"></i>
        <i data-lucide="sun" class="d-none theme-icon-light"></i>
        <i data-lucide="monitor" class="theme-icon-system"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 vt-card mt-2">
        <li><button class="dropdown-item d-flex align-items-center gap-2" data-theme-switcher="light"><i data-lucide="sun" style="width: 16px; height: 16px;"></i> Light</button></li>
        <li><button class="dropdown-item d-flex align-items-center gap-2" data-theme-switcher="dark"><i data-lucide="moon" style="width: 16px; height: 16px;"></i> Dark</button></li>
        <li><button class="dropdown-item d-flex align-items-center gap-2" data-theme-switcher="system"><i data-lucide="monitor" style="width: 16px; height: 16px;"></i> System</button></li>
    </ul>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const updateIcons = () => {
            const theme = localStorage.getItem('theme') || 'system';
            document.querySelectorAll('.theme-icon-dark, .theme-icon-light, .theme-icon-system').forEach(el => el.classList.add('d-none'));
            if(theme === 'dark') document.querySelectorAll('.theme-icon-dark').forEach(el => el.classList.remove('d-none'));
            else if(theme === 'light') document.querySelectorAll('.theme-icon-light').forEach(el => el.classList.remove('d-none'));
            else document.querySelectorAll('.theme-icon-system').forEach(el => el.classList.remove('d-none'));
        };
        updateIcons();
        document.querySelectorAll('[data-theme-switcher]').forEach(btn => btn.addEventListener('click', updateIcons));
    });
</script>