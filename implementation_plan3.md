# Phase 1.3: Enterprise Design System & UI Foundation

This plan outlines the architecture and implementation of the VoteTune UI foundation. The objective is to build a premium, modern SaaS design system (inspired by Linear, Vercel, Stripe) using Bootstrap 5, Vanilla CSS, and Blade Components.

## User Review Required
> [!IMPORTANT]
> - **Font Selection**: I plan to use **Inter** for the primary font to give it a modern SaaS feel (similar to Stripe/Linear).
> - **Color Palette**: I will establish a modern palette: sleek dark mode (deep gray/black) and clean light mode, with a vibrant primary accent color (e.g., a modern indigo/violet).

## Proposed Changes

### 1. CSS Architecture & Design Tokens
I will expand the CSS files in `resources/css/` to establish a robust design system.
#### [MODIFY] [app.css](file:///C:/xampp82/htdocs/VoteTune/resources/css/app.css)
Will import all modular CSS files.
#### [MODIFY] [variables.css](file:///C:/xampp82/htdocs/VoteTune/resources/css/variables.css)
Define global CSS variables for colors, typography, spacing, border-radius, and shadows. Includes Light and Dark mode specific variables.
#### [MODIFY] [theme.css](file:///C:/xampp82/htdocs/VoteTune/resources/css/theme.css)
Apply the theme variables to global HTML elements and Bootstrap overrides.
#### [MODIFY] [utilities.css](file:///C:/xampp82/htdocs/VoteTune/resources/css/utilities.css)
Custom utility classes for glassmorphism, background blurs, and specific layouts.
#### [MODIFY] [animations.css](file:///C:/xampp82/htdocs/VoteTune/resources/css/animations.css)
Micro-animations (fade-in, slide-up, pulse) for loaders and smooth page transitions.
#### [MODIFY] [responsive.css](file:///C:/xampp82/htdocs/VoteTune/resources/css/responsive.css)
Media query adjustments for mobile, tablet, and desktop viewports.

### 2. JavaScript Architecture
I will implement reusable JS modules in `resources/js/` and initialize them in `app.js`.
#### [MODIFY] [app.js](file:///C:/xampp82/htdocs/VoteTune/resources/js/app.js)
Import Bootstrap, jQuery, SweetAlert2, Lucide Icons, and our custom modules.
#### [MODIFY] [theme.js](file:///C:/xampp82/htdocs/VoteTune/resources/js/theme.js)
Logic for Light/Dark/System theme toggling, persisting preference to `localStorage`, and updating the `data-bs-theme` attribute.
#### [MODIFY] [ajax.js](file:///C:/xampp82/htdocs/VoteTune/resources/js/ajax.js)
Global wrapper for jQuery AJAX requests, automatically handling CSRF tokens and generic error catching.
#### [MODIFY] [toast.js](file:///C:/xampp82/htdocs/VoteTune/resources/js/toast.js)
Helper functions wrapping SweetAlert2 for standardized success, error, and info toast notifications.
#### [MODIFY] [datatable.js](file:///C:/xampp82/htdocs/VoteTune/resources/js/datatable.js)
Global configuration for Yajra DataTables (pagination styling, language, dom positioning, loaders).
#### [MODIFY] [modal.js](file:///C:/xampp82/htdocs/VoteTune/resources/js/modal.js)
Helpers for dynamically opening, updating, and closing Bootstrap modals.
#### [MODIFY] [helpers.js](file:///C:/xampp82/htdocs/VoteTune/resources/js/helpers.js)
General JS utilities (e.g., debouncing, string manipulation).

### 3. Blade Components (UI Elements)
I will create reusable Blade components in `resources/views/components/` to standardize the UI.
#### [NEW] `button.blade.php`, `card.blade.php`, `badge.blade.php`, `alert.blade.php`
#### [NEW] `input.blade.php`, `checkbox.blade.php`, `switch.blade.php`, `radio.blade.php`
#### [NEW] `dropdown.blade.php`, `tab.blade.php`, `table.blade.php`
#### [NEW] `loader.blade.php`, `skeleton.blade.php`, `empty-state.blade.php`

### 4. Layouts & Structure
I will construct the master layouts in `resources/views/layouts/`.
#### [MODIFY] [app.blade.php](file:///C:/xampp82/htdocs/VoteTune/resources/views/layouts/app.blade.php)
#### [MODIFY] [admin.blade.php](file:///C:/xampp82/htdocs/VoteTune/resources/views/layouts/admin.blade.php)
#### [MODIFY] [host.blade.php](file:///C:/xampp82/htdocs/VoteTune/resources/views/layouts/host.blade.php)
#### [MODIFY] [guest.blade.php](file:///C:/xampp82/htdocs/VoteTune/resources/views/layouts/guest.blade.php)

I will also create structural partials in `resources/views/partials/`:
#### [NEW] `navbar.blade.php`, `sidebar.blade.php`, `footer.blade.php`, `theme-switcher.blade.php`, `page-header.blade.php`, `search-bar.blade.php`, `user-dropdown.blade.php`, `notification-dropdown.blade.php`, `flash-message.blade.php`

### 5. Error Pages
Custom error pages overriding the default Laravel errors in `resources/views/errors/`:
#### [NEW] `404.blade.php`, `500.blade.php`, `503.blade.php` (Maintenance)

## Verification Plan

### Automated Checks
- `npm run build` to compile Vite assets and verify JS/CSS module resolution.
- `composer dump-autoload`
- `php artisan optimize`
- `php artisan route:list`

### Output Delivery
After execution, I will report the completion of Phase 1.3 without proceeding to Phase 2.
