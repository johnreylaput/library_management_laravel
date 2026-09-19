# AGENTS.md - Library Management System

## Project Overview

A Laravel 12 web application for UC Banilad's Library Management System. It provides
catalog management (books, journals, theses), member services (borrowing, reservations),
fine tracking, activity logging, and reporting for library administrators, librarians,
working students, and members.

## Framework & Stack

- **PHP** >= 8.2 (Laravel 12)
- **Database**: SQLite (local) or MySQL (production)
- **Frontend**: Bootstrap 5.3 + Bootstrap Icons, Tailwind CSS via Vite
- **Roles**: `Admin`, `Librarian`, `Working.Student`, `Member`

## Build / Run Commands

```bash
# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

# Development
composer dev          # or: php artisan serve
npm run dev           # Vite dev server

# Testing
composer test          # Clears config then runs PHPUnit

# Production
composer setup         # Full install + migrate + build
```

## Testing

Tests use PHPUnit with an in-memory SQLite database (`phpunit.xml`).

```bash
php artisan test          # All tests
php artisan test --filter=JournalBorrowTest    # Specific test class
```

Test files live in `tests/Feature/` and `tests/Unit/`.

## Code Standards

- Follow PSR-12 (Laravel Pint is included as a dev dependency).
- Run `vendor/bin/pint` to format code.
- Blade views use Bootstrap 5.3 conventions.

## Directory Structure

| Path | Purpose |
|------|---------|
| `app/Models/` | Eloquent models (all use SoftDeletes where applicable) |
| `app/Http/Controllers/Admin/` | Admin controllers for all resources |
| `app/Http/Controllers/Member/` | Member-facing controllers (borrow, reservation) |
| `app/Http/Middleware/` | `RoleMiddleware`, `SectionSelectionMiddleware` |
| `app/Console/Commands/` | Scheduled commands (notifications, expiry) |
| `database/migrations/` | Schema migrations |
| `database/seeders/` | Database seeders |
| `resources/views/` | Blade templates (admin, member, auth, layout) |

## Key Conventions

- **Soft deletes** are used on `Book`, `Journal`, `Thesis`, and other catalog models.
- **Activity logging** is recorded via `ActivityLog` model on login, logout, registration,
  borrow approval, and deletion requests.
- **Notifications** are system-level notifications stored in the `notifications` table.
- **Roles** are checked via `RoleMiddleware` (aliased as `role` in `bootstrap/app.php`).
- **Fine model** uses the `paid` field (`Yes`/`No`), not `status`.
