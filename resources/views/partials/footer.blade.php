<footer class="footer mt-auto py-4 vt-bg-surface vt-border-top">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center">
            <span class="text-secondary vt-body-small">© {{ date('Y') }} VoteTune. All rights reserved.</span>
            <div class="d-flex gap-3">
                <a href="{{ route('privacy') }}" class="text-secondary text-decoration-none vt-body-small">Privacy</a>
                <a href="{{ route('terms') }}" class="text-secondary text-decoration-none vt-body-small">Terms</a>
            </div>
        </div>
    </div>
</footer>