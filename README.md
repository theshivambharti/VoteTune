# VoteTune

## Project Overview
VoteTune is an enterprise-grade SaaS platform built with modern architectural patterns to ensure scalability and maintainability.

## Requirements
- PHP 8.2+
- MySQL 8+
- Composer
- Node.js & NPM

## Installation
1. Clone the repository: `git clone https://github.com/theshivambharti/VoteTune.git`
2. Install PHP dependencies: `composer install`
3. Install JS dependencies: `npm install`
4. Copy environment file: `cp .env.example .env`
5. Generate application key: `php artisan key:generate`
6. Create database and migrate: `php artisan migrate --seed`
7. Start development server: `php artisan serve` and `npm run dev`

## Development
- Architecture uses a strict Service-Repository pattern over standard MVC.
- Real-time components run on Laravel Reverb.
- Authentication utilizes Laravel Socialite for OAuth integrations.

## Documentation
Refer to the `/docs` folder for detailed specifications:
- `PROJECT_BIBLE.md` for environment, standards, rules, and tech stack details.
- `ARCHITECTURE.md` for folder structure and core architectural principles.
- `CHANGELOG.md` for version history.

## Coding Standards
- Strictly adhere to PSR-12, SOLID, DRY, and KISS.
- Keep Controllers thin (no business logic).

## Git Workflow
- All phases are committed to `main` with descriptive commit messages.
- Each phase is verified independently before continuing.
