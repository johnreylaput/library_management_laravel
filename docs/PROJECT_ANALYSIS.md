# Project Analysis Report

## Library Management System - UC Banilad

**Date:** 2026-09-19
**Laravel Version:** 12
**PHP Version:** >= 8.2

---

## 1. Executive Summary

This is a Laravel 12 web application for UC Banilad's Library Management System. The
application provides comprehensive library management functionality including catalog
management (books, journals, theses), member services (borrowing, reservations), fine
tracking, activity logging, reporting, and role-based access control.

The codebase is well-structured following Laravel conventions with a clear separation
between Admin, Member, and Auth controllers. The application supports four roles:
Admin, Librarian, Working.Student, and Member.

---

## 2. Project Statistics

| Metric | Count |
|--------|-------|
| **PHP Source Files (app/)** | 40+ |
| **Models** | 15 |
| **Controllers** | 20 |
| **Migrations** | 46 |
| **Seeders** | 10 |
| **Routes** | 30+ (web.php) |
| **View Templates** | 50+ Blade files |
| **Test Files** | 5 (3 Feature, 2 Unit) |
| **Console Commands** | 4 scheduled commands |

### Models

| Model | Soft Deletes | Relationships Defined |
|-------|-------------|----------------------|
| Book | Yes | None (missing) |
| Journal | Yes | category(), publisher() |
| Thesis | Yes | None (missing) |
| User | No | member() |
| Member | No | user(), borrowRecords() |
| BorrowRecord | No | member(), book(), journal(), thesis() |
| Reservation | No | member(), book(), journal(), thesis() |
| ReturnRecord | No | borrow() |
| Fine | No | borrow() |
| Category | No | journals(), theses() (import missing) |
| Author | No | None |
| Publisher | No | None |
| DeletionRequest | No | user(), reviewer() |
| Notification | No | user(), sender(), borrow(), reservation() |
| ActivityLog | No | user() |

### Controllers

| Controller | Location | Purpose |
|-----------|----------|---------|
| DashboardController | Admin | Role-based dashboards |
| BookController | Admin | CRUD for books |
| JournalController | Admin | CRUD for journals/periodicals |
| ThesisController | Admin | CRUD for theses |
| CategoryController | Admin | CRUD for categories |
| AuthorController | Admin | CRUD for authors |
| PublisherController | Admin | CRUD for publishers |
| MemberController | Admin | CRUD for members |
| UserController | Admin | CRUD for users (Admin+) |
| LibrarianController | Admin | CRUD for librarians (Admin only) |
| BorrowController | Admin | Borrow management + approval |
| ReturnController | Admin | Return processing |
| ReservationController | Admin | Reservation management + approval |
| FineController | Admin | Fine tracking |
| ReportController | Admin | Statistics and reporting |
| LogController | Admin | Activity logs (real-time) |
| DeletionRequestController | Admin | Deletion request workflow |
| RecentlyDeletedController | Admin | Soft-delete restoration |
| AuthController | Root | Login, register, logout |
| ProfileController | Root | Profile management |
| SearchController | Root | Book & e-periodical search |
| BorrowController | Member | Member self-service borrowing |
| ReservationController | Member | Member self-service reservations |

---

## 3. Architecture

### Role-Based Access Control

| Role | Permissions |
|------|------------|
| **Admin** | Full access to all features, user/librarian management |
| **Librarian** | CRUD on all catalog items, borrow/return/reservation processing, deletion request review (hardcoded username: `maria.librarian`) |
| **Working.Student** | CRUD on catalog items, borrow/return/reservation processing, submit deletion requests |
| **Member** | Borrow books/journals/theses, create reservations, view own dashboard |

### Data Models

- **Book**: Title, author, edition, year, subject, publication, added_by, edited_by
- **Journal**: Title, journal_name, authors, source, abstract, issn, doi, volume, issue,
  pages, publication_date, category, publisher, keywords, availability status
- **Thesis**: Author, research type (enum), date_published, subjects_keywords, summary
- **BorrowRecord**: Member, item (book/journal/thesis), borrow_date, due_date, status
  (Pending/Borrowed/Returned/Overdue/Cancelled)
- **Reservation**: Member, item (book/journal/thesis), reservation_date, due_date, status
  (Pending/Approved/Cancelled/Claimed)
- **Fine**: BorrowRecord, amount, reason, paid (Yes/No)
- **ReturnRecord**: BorrowRecord, returned_by, return_date, condition_status, remarks
- **DeletionRequest**: User, item_type, item_id, title, status, reason, reviewed_by
- **Notification**: User, type, borrow_id, reservation_id, title, message, is_read, sent_by
- **ActivityLog**: User, username, role, action, description, ip_address

### Scheduled Commands

| Command | Description |
|---------|-------------|
| `borrow:send-due-notifications` | Daily email notifications for due/overdue items |
| `records:expire-overdue` | Auto-cancel overdue borrows (>3 days past due) and expired pending reservations |
| `deletion-requests:expire` | Auto-expire pending deletion requests older than 3 days |

---

## 4. Known Issues & Recommendations

### Critical Issues

1. **Tracked development/debug scripts** (`comprehensive_test.php`, `debug_save.php`,
   `setup.php`): These are development/testing scripts committed to the repository.
   They should be removed from version control and added to `.gitignore`.

2. **Misplaced Dockerfile** (`resources/views/admin/authors/Dockerfile`): A Dockerfile
   is incorrectly placed inside the Blade views directory. The root-level `Dockerfile`
   is the correct one.

3. **Category model missing import** (`app/Models/Category.php:7`): The `HasMany`
   relationship is used but `use Illuminate\Database\Eloquent\Relations\HasMany;`
   is not imported. This will cause a runtime error.

4. **Reports view Fine status mismatch** (`resources/views/admin/reports/index.blade.php:497-503`):
   The Fine model uses `paid` field (Yes/No), but the reports view checks
   `$fine->status` which doesn't exist, causing fines to always show the "else"
   fallback badge.

### Medium Issues

5. **Duplicate routes in web.php** (lines 88-90): `show` routes for books, journals,
   and theses are manually defined but already covered by `Route::resource()` on
   lines 51-53. The duplicates are redundant.

6. **ThesisController redundant middleware** (lines 18-19): Both `except` and `only`
   middleware rules apply the same role check. The `except` rule is redundant since
   `only` covers the same methods.

7. **Thesis model missing relationships**: The Thesis model doesn't define any
   relationships (no `borrowRecords()`, `reservations()`, or `category()`),
   unlike other catalog models.

8. **Book model missing relationships**: The Book model doesn't define
   `borrowRecords()`, `reservations()`, or `category()` relationships.

### Low Issues

9. **Default Laravel README.md**: The README is the default Laravel boilerplate and
   does not describe this project.

10. **Root-level asset files**: `bg.png`, `lgn.png`, `logo.png`, `UCB.png`,
    `templib.png` exist at the project root and are duplicated in `public/images/`.

11. **SQL dump file**: `library_management_system (12).sql` is a database dump that
    should not be in version control.

12. **Missing AGENTS.md**: The project lacks an AGENTS.md file documenting conventions
    and workflows for code agents.

---

## 5. File Inventory Summary

### Root-Level Files (Non-Standard)

| File | Tracking | Recommendation |
|------|----------|----------------|
| `comprehensive_test.php` | Tracked | Remove from git + .gitignore |
| `debug_save.php` | Tracked | Remove from git + .gitignore |
| `setup.php` | Tracked | Remove from git + .gitignore |
| `library_management_system (12).sql` | Tracked | Remove from git |
| `Dockerfile` | Tracked | Keep (correct location) |
| `UCB.png` | Tracked | Remove (duplicated in public/images/) |
| `bg.png` | Tracked | Remove (duplicated in public/images/) |
| `lgn.png` | Tracked | Remove (duplicated in public/images/) |
| `logo.png` | Tracked | Remove (duplicated in public/images/) |
| `templib.png` | Tracked | Remove (duplicated in public/images/) |
| `.env` | Untracked | Correct - stays in .gitignore |

### Misplaced Files

| File | Current Location | Recommended Action |
|------|-----------------|-------------------|
| `Dockerfile` | `resources/views/admin/authors/` | Remove (duplicate of root Dockerfile) |
| `vercel.json` | `resources/views/profile/` | Remove (misplaced config) |

---

## 6. Environment Configuration

### .env Setup

The `.env.example` correctly references SQLite as the default database connection.
The production `.env` file exists locally but is properly gitignored.

### App Configuration

- **Auth mode**: Custom authentication (username-based, not email-based)
- **Session**: Database driver, 120-minute lifetime
- **Cache**: Database store
- **Mail**: Log driver (for development), SMTP configured for production
- **Queue**: Database connection
- **Frontend**: Vite + Tailwind CSS 4.0 + Bootstrap 5.3

---

## 7. Testing

The project has 5 test files using PHPUnit with in-memory SQLite:

- `tests/Feature/ExampleTest.php` - Basic smoke test
- `tests/Feature/JournalBorrowTest.php` - Journal borrowing workflows (member + admin)
- `tests/Feature/EPeriodicalActionsTest.php` - Journal CRUD + e-periodical views
- `tests/Unit/ExampleTest.php` - Trivial unit test (assertTrue)

**Test coverage**: Limited. Only journal borrowing and basic e-periodical actions
are tested. Books, theses, reservations, fines, returns, and auth flows have no test
coverage.

---

## 8. Cleanup Checklist

| # | Task | Priority | Status |
|---|------|----------|--------|
| 1 | Remove `comprehensive_test.php`, `debug_save.php`, `setup.php` from git | High | Pending |
| 2 | Remove `resources/views/admin/authors/Dockerfile` | Medium | Pending |
| 3 | Remove `resources/views/profile/vercel.json` | Low | Pending |
| 4 | Fix Category model `HasMissing` import | Critical | Pending |
| 5 | Fix reports view `$fine->status` -> `$fine->paid` | Critical | Pending |
| 6 | Remove duplicate show routes in web.php | Medium | Pending |
| 7 | Simplify ThesisController middleware | Medium | Pending |
| 8 | Add `AGENTS.md` | Medium | In Progress |
| 9 | Update `README.md` | Medium | Pending |
| 10 | Add dev scripts to `.gitignore` | Medium | Pending |
| 11 | Remove root-level duplicate asset files | Low | Pending |
| 12 | Remove `library_management_system (12).sql` from git | Medium | Pending |

---

## 9. Summary

The Library Management System is a substantial Laravel 12 application with
well-structured controllers, models, and views. The role-based access control is
thoroughly implemented with support for four distinct user roles. The application
includes real-time activity logs, scheduled notifications, soft-delete workflows,
and a comprehensive reporting dashboard.

However, the project has several issues that affect code quality and maintainability:
development scripts committed to version control, a missing model import that will
cause runtime errors, a field name mismatch in the reports view, duplicate routes,
and a misplaced Dockerfile. These issues are documented in this report and addressed
in the cleanup tasks.
