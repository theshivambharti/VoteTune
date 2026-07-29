# Phase 1.4: Authentication & Authorization Foundation

This plan outlines the architecture and implementation of VoteTune's secure Authentication and Authorization foundation using thin controllers and a robust Service layer.

## User Review Required
> [!IMPORTANT]
> - **Primary Key vs UUID**: I plan to keep the auto-incrementing integer `id` as the primary key for database performance (joins), but add a unique `uuid` column to the `users` table for external referencing. Please let me know if you prefer UUIDs as the absolute primary key instead.
> - **Socialite Configuration**: The implementation will support Google, Facebook, and Apple structures. Since we don't have credentials yet, I will place placeholders in `.env.example` and `.env` that you can fill out later.

## Proposed Changes

### 1. Database & Migrations
I will update the default Laravel migrations to support our enterprise requirements.
#### [MODIFY] [database/migrations/2014_10_12_000000_create_users_table.php](file:///C:/xampp82/htdocs/VoteTune/database/migrations/2014_10_12_000000_create_users_table.php)
- Add `uuid()`
- Make `password` nullable (to support Social Login users who don't have a password).
- Add `display_name`, `avatar`, `provider`, `provider_id` for Socialite.
- Add `account_status` (enum/string: active, suspended, etc.), `last_login_at`, `last_login_ip`.
- Add `softDeletes()`.

### 2. User Roles & Seeders (Spatie Permission)
I will publish Spatie migrations (if not already published) and create seeders.
#### [NEW] `database/seeders/RolesAndPermissionsSeeder.php`
- Seeds roles: Administrator, Host, User, Guest.
#### [NEW] `database/seeders/UserSeeder.php`
- Seeds an Administrator account, Demo Host, and Demo User, assigning them the proper Spatie roles.

### 3. Services Layer
I will build out the business logic inside the Service classes to keep controllers thin.
#### [NEW] `app/Services/AuthenticationService.php`
- Logic for standard Login (with rate limiting via Laravel RateLimiter), Logout (with session regeneration/invalidation), Registration, and Password Reset.
#### [NEW] `app/Services/SocialAuthenticationService.php`
- Handles the logic for Socialite redirects and callbacks (creating new users or logging in existing ones based on `provider_id`).
#### [NEW] `app/Services/UserService.php`
- Profile updates, password changes, and avatar uploads.
#### [NEW] `app/Services/RoleService.php` & `app/Services/PermissionService.php`
- Wrappers around Spatie to handle role assignments.
#### [NEW] `app/Services/SessionService.php`
- Logic for tracking and terminating sessions.

### 4. Form Requests (Validation)
#### [NEW] `app/Http/Requests/Auth/LoginRequest.php`
#### [NEW] `app/Http/Requests/Auth/RegisterRequest.php`
#### [NEW] `app/Http/Requests/Auth/ForgotPasswordRequest.php`
#### [NEW] `app/Http/Requests/Auth/ResetPasswordRequest.php`
#### [NEW] `app/Http/Requests/User/ProfileUpdateRequest.php`
#### [NEW] `app/Http/Requests/User/PasswordUpdateRequest.php`

### 5. Controllers
#### [NEW] `app/Http/Controllers/Auth/AuthController.php`
- Endpoints for standard auth, utilizing `AuthenticationService`.
#### [NEW] `app/Http/Controllers/Auth/SocialAuthController.php`
- Endpoints for OAuth providers, utilizing `SocialAuthenticationService`.
#### [NEW] `app/Http/Controllers/User/ProfileController.php`

### 6. Middleware
#### [NEW] `app/Http/Middleware/RoleMiddleware.php` & `PermissionMiddleware.php`
- Custom middleware aliases utilizing Spatie.
#### [NEW] `app/Http/Middleware/RedirectIfAuthenticated.php` (Update existing if needed)

### 7. Routes
#### [NEW] `routes/auth.php`
- Defined securely, wrapping routes with proper throttle limits. I will include this file inside `routes/web.php`.

### 8. Views (Using Phase 1.3 Design System)
I will construct the following views using the generic Blade components (`x-card`, `x-input`, `x-button`):
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/auth/forgot-password.blade.php`
- `resources/views/auth/reset-password.blade.php`
- `resources/views/auth/verify-email.blade.php`
- `resources/views/profile/edit.blade.php`
- `resources/views/profile/password.blade.php`

### 9. Placeholder Dashboards
I will create basic placeholder views to verify routing and middleware protection:
- `resources/views/admin/dashboard.blade.php`
- `resources/views/host/dashboard.blade.php`
- `resources/views/user/dashboard.blade.php`

## Verification Plan

### Automated Checks
- `composer dump-autoload`
- `php artisan migrate:fresh --seed` (to completely rebuild the DB with the new User schema and seeders)
- `php artisan optimize:clear`, `route:list`, `route:cache`, `config:cache`, `optimize`
- Verification of Login/Logout and Role middleware functionality.
