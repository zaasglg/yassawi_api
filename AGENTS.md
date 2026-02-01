# Repository Guidelines

## Project Structure & Module Organization
- `app/` holds application code (controllers, models, Filament resources).
- `routes/` defines HTTP routes; start with `routes/web.php` and `routes/api.php`.
- `resources/` contains Blade views, JS, and CSS assets; Vite builds from here.
- `database/` has migrations, seeders, and factories.
- `tests/` contains `Feature/` and `Unit/` test suites.
- `public/` is the web root for compiled assets.

## Build, Test, and Development Commands
- `composer install` installs PHP dependencies.
- `npm install` installs frontend tooling.
- `composer run setup` bootstraps env, key, migrations, and builds assets.
- `composer run dev` runs Laravel server, queue worker, Pail logs, and Vite dev server.
- `npm run dev` runs Vite only (useful for frontend work).
- `npm run build` builds production assets.
- `composer run test` clears config and runs the test suite.

## Coding Style & Naming Conventions
- PHP targets 8.2; follow Laravel conventions (PSR-12, class-per-file in `app/`).
- Use `./vendor/bin/pint` for formatting when changing PHP files.
- Routes: use kebab-case URIs; controllers use `PascalCase` class names.
- Frontend: Tailwind + Vite; keep component/file names in `PascalCase` for JS modules.

## Testing Guidelines
- Tests use Pest via `php artisan test` and live in `tests/Feature` and `tests/Unit`.
- Name tests descriptively (e.g., `LessonApiTest.php` or `it_allows_video_upload`).
- Prefer in-memory sqlite (configured in `phpunit.xml`) for fast tests.

## Commit & Pull Request Guidelines
- Recent commits are short, imperative, and often start with verbs like “Add” or “Fix”.
- Keep messages concise and meaningful (avoid placeholders).
- PRs should describe the change, include the commands run, and screenshots for UI changes.
- Link related issues when applicable and call out any migration or config changes.

## Security & Configuration Tips
- Copy `.env.example` to `.env` and set app key with `php artisan key:generate`.
- Keep secrets out of git; use `.env` for API keys and credentials.
