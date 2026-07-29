window.App = window.App || {};

App.theme = {
    init: function() {
        const storedTheme = localStorage.getItem('theme') || 'system';
        this.setTheme(storedTheme);

        document.querySelectorAll('[data-theme-switcher]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const theme = e.currentTarget.getAttribute('data-theme-switcher');
                this.setTheme(theme);
            });
        });

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (localStorage.getItem('theme') === 'system') {
                this.setTheme('system');
            }
        });
    },
    setTheme: function(theme) {
        localStorage.setItem('theme', theme);
        let activeTheme = theme;
        if (theme === 'system') {
            activeTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        document.documentElement.setAttribute('data-bs-theme', activeTheme);
        document.documentElement.classList.remove('theme-light', 'theme-dark');
        document.documentElement.classList.add('theme-' + activeTheme);
    }
};

document.addEventListener('DOMContentLoaded', () => App.theme.init());
