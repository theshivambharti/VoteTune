# Phase 01: Project Foundation and Enterprise Architecture

This phase focuses strictly on establishing the enterprise-grade foundation for VoteTune without implementing business logic.

## Proposed Changes

### 1. Project Initialization
- Run `composer create-project laravel/laravel` to initialize the latest Laravel 11 foundation.
- Configure MySQL 8+ database credentials.

### 2. Package Installation
- `yajra/laravel-datatables-oracle` (Yajra DataTables)
- `laravel/socialite` (OAuth authentication)
- Laravel Reverb (WebSockets for Laravel 11)
- Note: Bootstrap 5, jQuery, and SweetAlert2 will be integrated via CDN or local assets within layouts.

### 3. Folder Structure & Storage
- **App Directories:** `app/Actions`, `app/Console`, `app/Enums`, `app/Events`, `app/Exceptions`, `app/Helpers`, `app/Jobs`, `app/Listeners`, `app/Mail`, `app/Notifications`, `app/Observers`, `app/Policies`, `app/Providers`, `app/Repositories`, `app/Rules`, `app/Services`, `app/Traits`.
- **Controllers:** `Admin`, `Host`, `User`, `Api`, `Frontend`, `Common`.
- **Views:** `admin`, `host`, `user`, `frontend`, `layouts`, `components`, `partials`, `emails`, `errors`.
- **Public Uploads:** `public/uploads/` (with subdirectories: `logos`, `users`, `hosts`, `songs`, `plans`, `rooms`, `settings`, `documents`).

### 4. Routes Definition
- Manually define route files: `admin.php`, `host.php`, `user.php`, `api.php`, `web.php`.
- Register all custom route files properly in Laravel 11's routing system (via `bootstrap/app.php`).

### 5. Architectural Components
- **Enums:** `Role`, `Status`, `Plan`, `Notification`, `Room`, `Vote`.
- **Traits:** `Uploads`, `Responses`, `ActivityLogs`, `UUID`.
- **Helpers:** `ImageHelper`, `ResponseHelper`, `UploadHelper`, `CommonHelper`, `DateHelper`, `SettingHelper`, `QRCodeHelper`.
- **Services:** `SettingService`, `RoomService`, `VoteService`, `SongService`, `HostService`, `UserService`, `PlanService`, `AnalyticsService`, `SearchService`, `QRCodeService`, `NotificationService`.
- **Repositories:** Abstract interfaces and base implementations.
- **Middleware:** `Admin`, `Host`, `User`, `Guest`, `Role`, `Permission`, `ActiveSubscription`.
- **Seeders:** `AdminSeeder`, `RoleSeeder`, `PermissionSeeder`, `SettingSeeder`, `PlanSeeder`.
- **Configuration:** `settings.php`, `upload.php`, `plans.php`, `roles.php`, `reverb.php`, `youtube.php`.

### 6. Base Layout & UI Integration
- Extract layout structures from `C:\Users\SHIVA\Downloads\Telegram Desktop\view_admin_panel`.
- Copy `app-assets` to `public/app-assets`.
- Create Blade layouts: `Frontend`, `Admin`, `Host`, `User`.
- Create Shared Components: `Sidebar`, `Navbar`, `Footer`, `Breadcrumb`, `Page Header`, `Cards`, `Buttons`, `DataTable`, `SweetAlert`, `Modal`, `Loader`.

### 7. Documentation
- Generate empty/base Markdown files: `README.md`, `CHANGELOG.md`, `INSTALLATION.md`, `ARCHITECTURE.md`, `DATABASE.md`, `API_DOCUMENTATION.md`, `DEPLOYMENT.md`, `CONTRIBUTING.md`.

## User Review Required

> [!IMPORTANT]
> **Database Configuration**
> Since the project will need to pass validation steps like `php artisan migrate`, I will need standard MySQL database credentials to run these commands successfully. I will assume a standard local database named `votetune` with user `root` and no password. Let me know if your local setup requires different credentials.

## Verification Plan

### Automated Commands
- `php artisan optimize:clear`
- `php artisan route:list`
- `php artisan route:cache`
- `php artisan config:cache`
- `php artisan optimize`
- `php artisan migrate`
- `php artisan db:seed`

### Manual Verification
- Verify that all requested directories and files exist.
- Ensure the repository is synchronized with Git (`git add .`, `git commit`, `git push origin main`).
