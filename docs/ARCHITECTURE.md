# VoteTune Architecture

## Core Principles
VoteTune utilizes a Service-Repository pattern over the default MVC approach. This ensures scalability, testability, and separation of concerns.

## Folder Structure
```
VoteTune/
├── app/
│   ├── Actions/         # Single-responsibility action classes
│   ├── Console/         # Artisan commands
│   ├── DTOs/            # Data Transfer Objects
│   ├── Enums/           # PHP Enumerations
│   ├── Exceptions/      # Custom exception handlers
│   ├── Helpers/         # Helper functions/classes
│   ├── Http/
│   │   ├── Controllers/ # Thin controllers orchestrating requests
│   │   ├── Middleware/  # HTTP middleware
│   │   └── Requests/    # Form requests (Validation)
│   ├── Interfaces/      # Contracts (e.g., Repository interfaces)
│   ├── Models/          # Eloquent Models
│   ├── Observers/       # Eloquent Observers
│   ├── Policies/        # Authorization policies
│   ├── Repositories/    # Data access layer
│   ├── Rules/           # Custom validation rules
│   ├── Services/        # Business logic layer
│   └── Traits/          # Reusable PHP traits
├── config/              # Configuration files
├── database/            # Migrations, factories, and seeders
├── docs/                # Project documentation
├── public/              # Publicly accessible assets
├── resources/           # Views, CSS, JS
│   ├── css/             # CSS architecture (variables, theme, utilities)
│   ├── js/              # JS architecture (helpers, theme, ajax)
│   └── views/           # Blade templates (layouts, components, partials)
├── routes/              # Route definitions (web, api, admin, host, user)
├── storage/             # Compiled views, logs, file uploads
└── tests/               # Automated tests (Feature, Unit)
```

## Naming Conventions
Follow PSR-12 and the conventions detailed in `PROJECT_BIBLE.md`.

## Tech Stack
- **Backend:** Laravel 10 LTS (PHP 8.2+)
- **Frontend:** Bootstrap 5, jQuery, SweetAlert2, Lucide Icons, Blade
- **Real-Time:** Laravel Reverb
- **Database:** MySQL 8+
