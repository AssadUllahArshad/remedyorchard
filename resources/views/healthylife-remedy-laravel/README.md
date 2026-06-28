# HealthyLife Remedy — Laravel Blade Views & Admin UI

This package contains the full "Emerald Depth" dark redesign (Levels.com-inspired layout, your emerald brand colors) converted into Laravel Blade templates, plus a complete admin panel UI for managing articles, categories, subscribers, and messages.

**Scope of what's included:** views, layouts, routes file, and CSS only. No migrations, no models, no controllers' internal logic, no auth — you're wiring up the backend yourself, as discussed. Every view that expects data has a `@php ... @endphp` fallback block at the top showing example data, so every page renders out of the box before you've connected anything, and the fallback doubles as documentation for the exact shape each view expects.

---

## 1. Where everything goes

Copy into your existing Laravel app like this:

```
resources/views/          → copy into your project's resources/views/
public/css/                → copy into your project's public/css/
public/logo/                → copy into your project's public/logo/
routes/web.php              → merge into your project's routes/web.php (see note below)
```

`routes/web.php` here is a **reference**, not a drop-in replacement — merge its route definitions into your actual routes file, since yours probably already has other routes.

---

## 2. Controllers you need to create

The routes file references these controllers, none of which exist yet:

```
App\Http\Controllers\HomeController
App\Http\Controllers\ArticleController
App\Http\Controllers\CategoryController
App\Http\Controllers\PageController
App\Http\Controllers\NewsletterController
App\Http\Controllers\ContactController

App\Http\Controllers\Admin\DashboardController
App\Http\Controllers\Admin\Admin_ArticleController
App\Http\Controllers\Admin\Admin_CategoryController
App\Http\Controllers\Admin\Admin_SubscriberController
App\Http\Controllers\Admin\Admin_MessageController
App\Http\Controllers\Admin\Admin_SettingsController
```

(The `Admin_` prefix on a few names avoids clashing with the public `ArticleController`/`CategoryController` — rename freely, just keep `routes/web.php`'s `use` statements in sync.)

Each view file has a comment block near the top like:

```blade
{{--
    NOTE FOR BACKEND INTEGRATION:
    $latestArticles  -> expects a collection of Article models...
--}}
```

Read that block before wiring a controller method — it tells you exactly which variables and relationships the view expects.

---

## 3. Suggested Eloquent models

Not included (per your request), but every view is written assuming these will eventually exist:

- **Article**: `title`, `slug`, `excerpt`, `body` (HTML from the Quill editor — sanitize before saving), `thumbnail_url`, `read_time`, `status` (draft/published/scheduled), `published_at`, `meta_title`, `meta_description`, belongs to `Category` and `Author`.
- **Category**: `name`, `slug`, `icon` (a Bootstrap Icons class like `bi-apple`), `description`, has many `Article`.
- **Author**: `name`, `role`, `initials` (or `avatar_url`).
- **Subscriber**: `email`, `source`, `subscribed_at`.
- **ContactMessage**: `name`, `email`, `subject`, `body`, `type` (contact/advertise), `read` (bool), `received_at`.

---

## 4. The rich text editor (Quill)

`resources/views/admin/articles/_form_fields.blade.php` loads **Quill 2.0.2** from a CDN and wires it to a hidden `<textarea name="body">`. On submit, JS copies Quill's HTML output into that textarea so it posts normally with the rest of the form — no JS framework or build step required.

**Important:** Quill's output is raw HTML. Before saving `$request->input('body')` to the database, run it through an HTML sanitizer (e.g. the `mews/purifier` package, which wraps HTMLPurifier) to strip anything dangerous. The article show view renders this field with `{!! $article->body !!}` (unescaped), so unsanitized input is a real XSS risk.

---

## 5. Auth — currently none

`admin/login.blade.php` is a **visual-only** login screen. The form's `action="#"` and there's no session/guard logic anywhere. Before deploying, at minimum:

1. Install Laravel Breeze, Fortify, or roll your own guard.
2. Wrap the entire `admin.` route group in `routes/web.php` with `->middleware(['auth'])` (and ideally a role check, e.g. `->middleware(['auth', 'can:access-admin'])`).
3. Point the login form's `action` at your real login route and add the `@csrf` token (already present) plus validation.

---

## 6. CSS structure

- `public/css/style.css` — the full public-site design system (colors, typography, hero, cards, footer, etc.) using CSS custom properties (`--emerald-deep`, `--emerald-brand`, `--emerald-bright`, etc. — defined at the top of the file).
- `public/css/admin.css` — extends the same custom properties for the admin panel (sidebar, tables, forms, stat tiles). Both files must be loaded together; `admin.css` relies on variables defined in `style.css`.

Both are plain CSS — no Sass/build step. If your Laravel project uses Vite, you can either keep linking these from `public/` directly (as the views currently do via `asset()`), or move them into `resources/css/` and import them from your Vite entry point if you'd rather they go through the asset pipeline.

---

## 7. Logo files

Three SVGs in `public/logo/`:
- `logo-dark-bg.svg` — full wordmark + icon, for dark backgrounds (used inline in the header/footer Blade partials already, so editing the SVG file itself won't affect those — see note below).
- `logo-light-bg.svg` — same, for light backgrounds.
- `icon-mark.svg` — icon only, used as the favicon.

**Note:** the header/footer partials and admin layout currently **inline** the dark-background logo's SVG markup directly rather than `<img>`-referencing the file, so it always renders crisply with no extra request. If you update the logo, update both the SVG file *and* the inline `<svg>` markup in `partials/header.blade.php`, `partials/footer.blade.php`, and `admin/layouts/admin.blade.php`.

---

## 8. Pages included

**Public:** Home, Remedies (article index), Category show, Article show, About, Contact, Privacy Policy, Terms of Use, Cookie Policy, Medical Disclaimer, Advertise.

**Admin:** Login (visual only), Dashboard, Articles (index/create/edit with Quill), Categories (index/create/edit), Subscribers, Messages (index/show), Settings.

All admin list/table pages include realistic example data so you can see the full design before any backend exists — just remove the `?? [...]` fallback arrays once your controllers are passing real data.
