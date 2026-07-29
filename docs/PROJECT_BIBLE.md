# VoteTune Project Bible

## 1. Environment
- **Local Dev:** XAMPP (Windows)
- **PHP:** 8.2+
- **Database:** MySQL 8+ (via XAMPP)
- **Node:** LTS
- **Package Managers:** Composer (PHP), NPM (Node)

## 2. Tech Stack
- **Framework:** Laravel 10 LTS
- **Frontend:** Bootstrap 5, jQuery, SweetAlert2, Lucide Icons, Blade Templates
- **Real-time:** Laravel Reverb (WebSocket)
- **Auth:** Laravel Socialite (OAuth)
- **Data:** Yajra DataTables
- **Permissions:** Spatie Laravel Permission
- **Code Quality:** Laravel Pint, PHPStan, Laravel IDE Helper

## 3. Coding Standards
- Strictly adhere to **PSR-12** formatting.
- Follow **SOLID** principles and keep controllers thin.
- Utilize the **Service Layer** for all business logic.
- Validate all incoming requests using **Form Requests**.
- Use **UUIDs** where appropriate for unique identification.
- Keep the code **DRY** (Don't Repeat Yourself) and **KISS** (Keep It Simple, Stupid).

## 4. Git Workflow
- `main` branch is the sole source of truth.
- Each phase must have its own descriptive commit.
- Never skip commits or pushes.
- Wait for approval before proceeding to the next phase.

## 5. UI Standards
- Modern, minimal, premium, and elegant.
- Glassmorphism, rounded corners, soft shadows.
- No generic admin panel templates.
- Inspiration: Spotify, Discord, Apple Music, Vercel.

## 6. Naming Conventions
- **Controllers**: PascalCase, suffixed with `Controller` (e.g., `UserController`).
- **Services**: PascalCase, suffixed with `Service` (e.g., `UserService`).
- **Repositories**: PascalCase, suffixed with `Repository` (e.g., `UserRepository`).
- **Models**: PascalCase, singular (e.g., `User`).
- **Tables**: snake_case, plural (e.g., `users`).
- **Variables/Properties**: camelCase (e.g., `$userName`).
- **Methods**: camelCase (e.g., `getUserByEmail()`).

## 7. Service Layer Rules
- Controllers must never contain business logic. They only handle HTTP requests/responses and call Services.
- Services encapsulate all business logic, validation (beyond basic HTTP validation), and complex operations.
- Services should be injected into Controllers via dependency injection.

## 8. Repository Rules
- Repositories abstract the database layer and Eloquent ORM.
- Services interact with Repositories to fetch or persist data, never directly using Models for complex queries.
- Repositories must implement specific Interfaces (e.g., `UserRepositoryInterface`).
