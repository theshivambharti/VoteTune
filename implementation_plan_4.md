# Phase 2: Website Settings & System Configuration

This plan outlines the implementation of the enterprise-grade Settings module for VoteTune, which will serve as the central configuration source of truth.

## User Review Required
> [!IMPORTANT]
> - **File Uploads**: Settings like Logo and Favicon require file storage. I will configure the `SettingService` to handle image uploads and store them in the `public/storage/settings` directory. Ensure you have run `php artisan storage:link` previously, or I will include it in the validation steps.
> - **Helper Auto-loading**: I will create an `app/helpers.php` file and register it in `composer.json` under `"files"`. This enables the global `setting('key')` helper function.

## Proposed Changes

### 1. Database & Models
#### [NEW] Migration: `create_settings_table`
- Columns: `id`, `group`, `key`, `value` (text/nullable), `type` (string: string, boolean, file, password, integer), `description`, `is_public` (boolean), `is_encrypted` (boolean), `autoload` (boolean), `sort_order` (integer), `timestamps`.
- Unique constraint on `key`.

#### [NEW] Model: `app/Models/Setting.php`
- Configure fillable fields, scopes for `autoload` and `group`.

### 2. Core Architecture (Service/Repository Pattern)
#### [NEW] `app/Repositories/SettingRepository.php`
- **Responsibilities**: Interface with the database, handle Laravel Cache.
- **Cache Strategy**: All settings will be cached indefinitely under a single cache key (`settings.all`) or grouped keys to prevent N+1 queries. Updating any setting flushes and rebuilds this cache.

#### [NEW] `app/Services/SettingService.php`
- **Responsibilities**: Business logic, handling file uploads for image settings, encrypting values when `is_encrypted` is true (using Laravel's `Crypt` facade), grouping logic for the UI, and input validation.

### 3. Global Helpers
#### [NEW] `app/helpers.php`
- Implements `setting($key, $default = null)` which pulls directly from the `SettingRepository`'s cached array. Fast and O(1) retrieval.
- Auto-loaded via `composer.json`.

### 4. Controller & Form Requests
#### [NEW] `app/Http/Controllers/Admin/SettingController.php`
- Extremely thin. Fetches grouped settings from the Service, passes them to the view. Handles mass updates.
#### [NEW] `app/Http/Requests/Admin/UpdateSettingsRequest.php`
- Validates inputs (e.g. ensuring images are actually images, emails are valid, etc.).

### 5. Routing
#### [NEW] `routes/admin/settings.php`
- Registered within `routes/web.php` under the `/admin` prefix and protected by the `role:Administrator` middleware.

### 6. Seeder
#### [NEW] `database/seeders/SettingSeeder.php`
- Seeds all the required groups: General, Branding, SEO, SMTP, Social Login, Analytics, Contact, Social Media, Localization, Appearance, Security, Upload Settings, Maintenance, and System.
- Ensures sensitive keys (like `smtp_password`) have `is_encrypted` set to true.

### 7. Admin UI (Using Phase 1.3 Design System)
#### [NEW] `resources/views/admin/settings/index.blade.php`
- Features a premium layout with a vertical sidebar navigating between settings groups (General, Branding, etc.).
- Uses `x-card`, `x-input`, `x-switch` components.
- Securely masks encrypted fields (like SMTP Password) from being displayed in the HTML source, providing a secure "Update to change" interface instead.
- Sticky save button and success notifications using `App.toast`.

## Verification Plan
- Create the custom helper file and run `composer dump-autoload` to register it.
- Run `php artisan migrate` and `php artisan db:seed --class=SettingSeeder`
- Run caches: `optimize:clear`, `route:cache`, `config:cache`
- Confirm `setting('site_name')` globally returns the correct seeded value.
