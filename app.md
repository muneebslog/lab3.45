# Lab Application — Full Specification for Replication

This document describes the **Mohsin Clinical Laboratory** Laravel application in `C:\laragon\www\lab` (portable path: project root `lab/`). An AI or developer can recreate the same behavior, routes, data model usage, and UI by implementing everything below. **Binary assets** (images, built Vite output) must be copied or recreated separately; **exact Blade/HTML** should be taken from the repo files named here.

---

## 1. Purpose and domain

- **Domain**: Clinical lab workflow — register patients, attach catalog **tests**, enter **per-field results**, print/view **invoices** and **reports** (with letterhead or minimal header), admin **Filament** CRUD for master data.
- **Branding in UI**: “Mohsin” clinical laboratory; address/contact blocks in report layouts (Lahore, phone numbers, website mohsinmedicalcomplex.com).
- **Auth**: Laravel Breeze-style **email + password** with **Livewire Volt** pages; `dashboard` and `profile` require auth; **Filament admin** at `/admin` uses its own login.

---

## 2. Runtime stack (exact versions from manifests)

### PHP / Composer (`composer.json`)

| Package | Constraint |
|---------|------------|
| PHP | `^8.2` |
| laravel/framework | `^11.9` |
| livewire/livewire | `^3.4` |
| livewire/volt | `^1.0` |
| filament/filament | `^3.2` |
| laravel/octane | `^2.12` |
| simplesoftwareio/simple-qrcode | `^4.2` |
| laravel/tinker | `^2.9` |

**Dev**: `laravel/breeze ^2.1`, `pestphp/pest ^2.0`, `barryvdh/laravel-debugbar`, `laravel/pint`, `laravel/sail`, etc.

### Node (`package.json`)

- **type**: `module`
- **Scripts**: `npm run dev` → `vite`; `npm run build` → `vite build`
- **devDependencies**: `vite ^5`, `laravel-vite-plugin ^1`, `tailwindcss ^3.1`, `@tailwindcss/forms`, `@tailwindcss/typography`, `autoprefixer`, `postcss`, `postcss-nesting`
- **dependencies**: `preline ^2.3.0`, `puppeteer ^22.13.0` (listed but **not referenced** in application JS/PHP in this repo)

### Frontend integration

- **Vite** entrypoints: `resources/css/app.css`, `resources/js/app.js` (`resources/js/app.js` is **empty** in repo).
- **Tailwind** (`tailwind.config.js`): uses **Filament preset** `import preset from './vendor/filament/support/tailwind.config.preset'`; **content** globs: `./app/Filament/**/*.php`, `./resources/views/**/*.blade.php`, `./vendor/filament/**/*.blade.php`.
- **CSS** (`resources/css/app.css`): only `@tailwind` layers.
- **Vite refresh** (`vite.config.js`): Laravel plugin `refresh` includes Filament/Livewire paths under `app/`.

---

## 3. Bootstrap and providers

### `bootstrap/app.php`

- Routes: `web` → `routes/web.php`, `commands` → `routes/console.php`, **health** → `GET /up`.
- No custom global middleware registered in the callback (defaults only).

### `bootstrap/providers.php` (order)

1. `App\Providers\AppServiceProvider`
2. `App\Providers\Filament\AdminPanelProvider`
3. `App\Providers\VoltServiceProvider`

### `AppServiceProvider::boot()`

- Calls `Model::unguard()` — **all Eloquent models are globally unguarded** (mass assignment not blocked by `$fillable` at runtime; `$fillable` still documents intent).

### `VoltServiceProvider::boot()`

- `Volt::mount([config('livewire.view_path', resource_path('views/livewire')), resource_path('views/pages')])`
- Volt auth views live under `resources/views/livewire/pages/auth/`. The second path `resources/views/pages` may be absent; harmless if unused.

### Filament `AdminPanelProvider`

- Default panel, **id** `admin`, **path** `admin`, **login enabled**.
- **Primary color**: `Color::Amber`.
- **Resources**: auto-discover `app/Filament/Resources`.
- **Pages**: discover `app/Filament/Pages` (folder may be empty) + explicit `Filament\Pages\Dashboard`.
- **Widgets**: discover `app/Filament/Widgets` + `AccountWidget`, `FilamentInfoWidget`.
- Standard Filament middleware stack (EncryptCookies, StartSession, VerifyCsrfToken, SubstituteBindings, etc.) and `Authenticate` for panel.

---

## 4. Routes (complete)

### `routes/web.php`

| Method | URI | Handler | Route name |
|--------|-----|-----------|------------|
| GET | `/` | `view('welcome')` | — |
| GET | `dashboard` | `view('dashboard')` | `dashboard` |
| GET | `profile` | `view('profile')` | `profile` |
| GET | `invoice/{id}` | `App\Livewire\Invoice` | `invoice` |
| GET | `caselist` | `App\Livewire\ListCases` | `cases-list` |
| GET | `test/addresults/{patientId}/{testId}` | `App\Livewire\AddResults` | `addResults` |
| GET | `report/show/{id}` | `App\Livewire\ShowReport` | `showreport` |
| GET | `report/show/noheader/{id}` | `App\Livewire\NoHeaderShowReport` | `noheaderreport` |
| GET | `report/edit/{patientId}/{testId}` | `App\Livewire\EditReport` | `editreport` |
| GET | `patient/edit/{id}` | `App\Livewire\PatientEdit` | `patientEdit` |
| GET | `invoice/{invoiceId}/download` | `App\Http\Controllers\invoiceController` (invokable) | `invoiceDownload` |
| GET | `letterpad` | `App\Http\Controllers\LetterPadController` | `letterpad` |
| GET | `report/view/{id}` | `App\Http\Controllers\TestViewController` | `reportShow` |
| GET | `newcase/` | `App\Livewire\NewformFilament` | `new-case` |

**Middleware on views**: `dashboard` uses `auth`, `verified`; `profile` uses `auth`.

**Commented / unused in file**: alternate `newcase` with `NewCase`; QR route.

**Quirk**: `use App\Livewire\LetterPad;` is imported but **no such class exists** and the route uses `LetterPadController`. The import is dead (harmless in PHP until referenced).

**Requires** `routes/auth.php` at end.

### `routes/auth.php` (Volt + verification)

- **Guest**: Volt `register`, `login`, `forgot-password`, `reset-password/{token}` with names `register`, `login`, `password.request`, `password.reset`.
- **Auth**: Volt `verify-email` (`verification.notice`); `GET verify-email/{id}/{hash}` → `App\Http\Controllers\Auth\VerifyEmailController` with `signed`, `throttle:6,1`, name `verification.verify`; Volt `confirm-password` (`password.confirm`).

### `routes/console.php`

- Schedules `inspire` Artisan command **hourly** (default Laravel stub).

### API

- **No** `routes/api.php` in project.

---

## 5. Database: committed migrations vs. domain tables

### Migrations present (Laravel 11 defaults only)

1. `0001_01_01_000000_create_users_table.php` — `users`, `password_reset_tokens`, `sessions`
2. `0001_01_01_000001_create_cache_table.php` — `cache`, `cache_locks`
3. `0001_01_01_000002_create_jobs_table.php` — `jobs`, `job_batches`, `failed_jobs`

### Domain tables **required by code** but **not** in repo migrations

You must create schema (migrations or SQL) matching Eloquent usage:

#### `patients`

- Used fields: `id`, `name`, `age`, `age_unit`, `phone`, `gender`, `doctor`, `receipt_no`, `created_at`, `updated_at`
- Types implied: strings/text for names; `age` used as displayed scalar; `gender` values `male` / `female` in forms; `phone` nullable in new case form.

#### `tests`

- Used fields: `id`, `name`, `code` (compared to integers like `1122`, `2800`, `2831`, `1300`, `2802`, `4232`, `4235` in Blade — store numeric-friendly type), `short_hand`, `price`, `comment`, **`department`** (Filament form; not in `$fillable` but unguarded allows it), timestamps.

#### `patient_test` (pivot; also `PatientTest` model)

- Table name **must** be `patient_test` (`Patient::$table` implicit; `PatientTest` sets `protected $table = 'patient_test'`).
- Columns used:
  - `id` (explicit pivot id: `withPivot('isResultAdded','isPrinted','id')`)
  - `patient_id`, `test_id`
  - `isResultAdded` (0/1)
  - `isPrinted` (in pivot; rarely used in blades shown)
  - timestamps typical but not always required by code

#### `test_fields`

- Fields: `id`, `field_name`, `unit`, `multiple_ranges` (truthy for gendered ranges), `min_value`, `max_value`, timestamps.

#### `test_test_field` (default many-to-many pivot for `Test` ↔ `TestField`)

- Laravel default name; `belongsToMany` without custom table name.

#### `test_results`

- Fields: `id`, `patient_test_id`, `test_field_id`, `result` (string; can hold JSON string for array results), timestamps.

#### `normal_ranges`

- Model table `normal_ranges`: `id`, `test_field_id`, `min_value`, `max_value`, `gender` (values include patient `male`/`female`, and **`all`** as fallback in PHP/Blade logic — Filament relation manager only offers `male`/`female`; seed or edit DB for `all` if needed).

### Seeder

- `DatabaseSeeder`: creates one `User` via factory: `name` “Test User”, `email` `test@example.com` (password per `UserFactory` default hashing).

---

## 6. Eloquent models (behavior)

### `User`

- Standard Breeze user: `fillable` name, email, password; `hidden` password, remember_token; casts `email_verified_at`, hashed `password`.

### `Patient`

- `fillable`: `name`, `age`, `age_unit`, `phone`, `gender`, `doctor`, `receipt_no`
- `tests()`: `belongsToMany(Test::class)->withPivot('isResultAdded','isPrinted','id')`

### `Test`

- `fillable`: `name`, `code`, `short_hand`, `price`, `comment`
- `testFields()`: `belongsToMany(TestField::class)`
- `Patients()`: `belongsToMany(Patient::class)` (note capital **P** method name)

### `TestField`

- `fillable`: `field_name`, `unit`, `multiple_ranges`, `min_value`, `max_value`, `created_at`, `updated_at`
- `tests()`, `normalRanges()`, `patientTests()` via `hasManyThrough(PatientTest::class, TestResult::class, 'test_field_id', 'patient_test_id')`

### `PatientTest`

- `table`: `patient_test`
- `fillable`: `isResultAdded`, `isPrinted` (DB still needs `patient_id`, `test_id`)
- `patient()`, `test()`, `testResults()`

### `TestResult`

- `fillable`: `patient_test_id`, `test_field_id`, `result`
- `patientTest()`, `testField()`

### `NormalRange`

- `table`: `normal_ranges`
- `fillable`: `test_field_id`, `min_value`, `max_value`, `gender`

---

## 7. HTTP controllers

### `invoiceController` (class name lowercase `invoice` in filename)

- **Invoke** `( $invoiceId )`: load `Patient::with('tests')->find($invoiceId)`, sum `price` of tests, return `view('invoices.show', ['patient' => $data, 'total' => $total])`.
- File contains `use Spatie\Browsershot\Browsershot;` and commented Browsershot PDF code — **package not in composer.json**; only the `use` and comments matter for replication (or remove for clean build).

### `LetterPadController`

- Returns `view('invoices.letterpad')` (static letterhead shell).

### `TestViewController`

- Returns `view('tests.cbc')` — file **`resources/views/tests/cbc.blade.php` is missing** in repo; route will error until created.

### `QRcodeGenerateController::qrcode()`

- Builds several `QrCode::...` variants, returns `view('qrcode', $qrCodes)`. Route to this method is **commented** in `web.php`.

### `Auth\VerifyEmailController`

- Standard signed verification; redirects to `dashboard` with query param; dispatches `Verified` event.

---

## 8. Livewire components (class-based)

All live under `app/Livewire` unless noted; views under `resources/views/livewire/*.blade.php` (kebab-case matching component name).

### `Invoice` (`invoice`)

- **Mount** `id`: `Test::all()`, load patient with tests, sum prices into `$total`.
- **add()**: `attach` selected `$test` id to patient; refresh.
- **delTest($id)**: `detach`; refresh.
- **getData()**: reload patient + recalc total.
- **View**: `livewire.invoice` — uses `QrCode::size(60)->generate(route('invoice', $patient->id))`, Preline-style layout, links to `addResults`, `editreport`, `showreport`, `noheaderreport`, `$set('testField', true)` to show add-test form.

### `ListCases` (`list-cases`)

- **State**: `$patients`, `$dateFrom`, `$dateTo` (strings `Y-m-d`), `$search`.
- **mount**: both dates = today; `getData()`.
- **getData**: `Patient::whereBetween('created_at', [startOfDay(from), endOfDay(to)])` swapping if from > to; `orderBy('created_at','desc')`; `with('tests')`; if search non-empty, `where` on `name` or `phone` `LIKE`.
- **Hooks**: `updatedDateFrom`, `updatedDateTo`, `updatedSearch` → `getData()`.

### `AddResults` (`add-results`)

- **Mount** `patientId`, `testId`: eager load patient with `tests` constrained to pivot `isResultAdded` 0 and `test_id` = testId; `tests.testFields.normalRanges`.
- **Special order**: if `$test->code == 2831` (integer), sort `testFields` by fixed map of **test field ids** (114, 106, 105, 107, 109, 118, 68, 67, 100, 111, 84) matching labels in mapping array.
- **Per field**: if `multiple_ranges == 1`, set `min_value`/`max_value` from `normalRanges` where `gender` matches patient, else fallback `gender == 'all'`.
- **save()**: iterates `$this->results` as `[testId => [fieldId => value]]`; finds `PatientTest` by patient + test; creates `TestResult` rows; maps shortcuts: `n`→`Nil`, `P`→`Positive`, `N`→`Negative`, `W`→`Whool Blood`, `Compatible`/`compatible`→` Donor Cells are Compatible With Patient's Serum`; arrays json-encoded; sets pivot `isResultAdded = 1`; **redirect** `route('invoice', $this->patient_id)`.
- **View quirk**: buttons call `wire:click='save({{ $test->id }})'` but PHP method is `save()` **without parameters** — in PHP 8 this can throw **ArgumentCountError** when clicked; a faithful bug-for-bug replica matches this; a fixed replica should use `save()` with no args or add an optional parameter.

### `EditReport` (`edit-report`)

- **Mount**: load `PatientTest` by patient + test ids with relations; fill `$results[fieldId]`; same multi-range min/max resolution as AddResults.
- **save()**: same value transforms as AddResults; update or create each `TestResult`; redirect `route('invoice', $this->patientId)`.

### `ShowReport` (`show-report`)

- **Mount** `id`: `PatientTest::with('patient','test','testResults')` — note `testResults` should load `testField` for nested blades (ensure eager load in view or add `testResults.testField`).
- **render**: `view('livewire.show-report')->layout('invoices.letterpad')`.
- **Layout slot**: Blade uses `<x-slot name="no">` with `$data->id` for medical record display in letterpad.

### `NoHeaderShowReport` (`no-header-show-report`)

- **Mount**: load `PatientTest`; filter out empty results; reorder so **ESR** field is at **index 8** (9th row) if present elsewhere; set `$resultCount`.
- **render**: layout `invoices.noheader`.

### `PatientEdit` (`patient-edit`)

- **Mount**: route-model binding `Patient $id` (parameter name `id`); populate form fields; property `$reciept` maps to DB `receipt_no`.
- **update()**: validate name, age, gender, reciept; update patient; redirect `cases-list` on success.

### `NewformFilament` (`newform-filament`)

- Uses Filament `InteractsWithForms`, `Form` with:
  - `name` required max 100
  - `receipt_no` numeric required max 100
  - Section 2 columns: `age` numeric; `age_unit` select Month/Year default Year required
  - `gender` male/female default male
  - `phone` tel numeric nullable max 12 min 11
  - `doctor` required “Refered By” — same option list as `patient-edit` (including trailing space on `'Dr. Arslan '` in Filament form)
  - `tests` multiselect `Test::all()->pluck('name','id')` required
- **create()**: `Patient::create(...)`, `attach` tests, Filament success notification, redirect `/invoice/{id}`.

### `NewCase` (`new-case`)

- Legacy flow: lookup test by `code` OR `short_hand`, build in-memory `$tests` array, **save()** contains `dd($testIds)` — **intentionally stops execution**; route is commented out in favor of `NewformFilament`.

### `Livewire\Forms\LoginForm`

- Breeze Volt login: validation, rate limiting, `Auth::attempt`, `session()->regenerate()`.

### `Livewire\Actions\Logout`

- Logout web guard, invalidate, regenerate CSRF.

---

## 9. Filament resources (admin)

Navigation icon for all: `heroicon-o-rectangle-stack`.

### `PatientResource`

- **Form**: name required 100; age numeric; gender male/female required; phone tel 11–12; tests `Select` `relationship('tests','name')` multiple required preload.
- **Table**: name searchable; age sortable; phone searchable; timestamps toggled hidden by default.
- **Relations**: `TestsRelationManager` on `tests` — table column name; create/edit/delete on pivot records (Filament default behavior).
- **Pages**: List, Create, Edit only.
- **Orphan**: `PatientResource\Pages\PatientEntry` points to view `filament.resources.patient-resource.pages.patient-entry` (almost empty `<x-filament-panels::page/>`) and is **not** registered in `getPages()`.

### `TestResource`

- **Form**: name required 255; **department** required select: HEMATOLOGY, SEROLOGY, BIOCHEMISTRY, MICROBIOLOGY, `BLOOD BANKING ` (trailing space), `PCR `, `ELISA ` (trailing spaces as in code); code required unique on `tests.code`; short_hand optional; price required numeric prefix Rs max 42949672.95; comment textarea; multiselect `testFields` with createOptionForm (field_name, unit, min, max required).
- **Table**: name, code, short_hand searchable.
- **Relation**: `TestFieldsRelationManager`.

### `TestFieldResource`

- **Form**: field_name, unit, min, max required; checkbox `multiple_ranges`.
- **Table**: id searchable; field_name, unit searchable; min/max numeric sortable; timestamps hidden by default.
- **Relation**: `NormalRangesRelationManager` — gender select **male** / **female** only in form; min/max numeric required.

### `TestResultResource`

- **Form**: broken/odd — `Select::make('patient_id')->relationship('patientTest', 'id')` on model that has no `patient_id` (uses `patient_test_id`). Replicate as-is if matching repo exactly.
- **Table**: patient_test_id, test_field_id, result (all sortable); timestamps hidden.
- **Pages**: List, Create, Edit.

---

## 10. Report and invoice presentation logic (critical)

### Static JSON driving report branches

- **`public/test_codes.json`**: `{ "codes": [2800, 4232, 4801, 4250, 4233, 4200, 4201, 4235, 2830, 2831] }` (spacing as in file). Reports use `in_array($data->test->code, $codes['codes'])` for simplified table layouts.

### `show-report.blade.php` / `no-header-show-report.blade.php` (mostly parallel)

Branches (simplified):

1. **`code == 1122` (urine-style)**: two tables — physical exam fields with `testField->id` between 40–52; microscopic 53–62 with `/HPF` suffix for ids 53,54,55,58,59,60.
2. **Code in `test_codes.json`**:
   - **2800**: two-column bold rows.
   - **4232**: centered second column.
   - **4235**: sort fields by name keys hbsag, anti hcv, hiv, vdrl.
   - **2831**: cross-match grid using **test_field_id** map (same ids as AddResults); donor tests row; typo “Donnor” in labels; **no-header** variant adds Patient Age column in grid vs header-only in header version differs slightly (compare files).
   - **default** in this block: generic two-column bold table.
3. **`code == 2802`**: Widal-style grid — group `testField->field_name` by substring before ` 1:`; columns titers `1:20` … `1:320`; uses `Str::before`; footer note block with HTML entities for ampersands.
4. **Else**: main table with columns Test Name, Normal Value, Unit, flag (L/H), Result:
   - If unit is `minutes:seconds` (case-insensitive), parse `mm:ss` to seconds for range compare.
   - If `multiple_ranges`, use `normalRanges` by patient gender then `all`.
   - **1300** CBC: insert “Differential Leukocytes Count:” row after specific index depending on result count 13 (after index 8) or 12 (after index 7).

**No-header** view ends with `{{ $data->test->comment }}` centered; header version does not show that block in the same place (verify file).

### Letter layouts

- **`invoices/letterpad.blade.php`**: Google fonts Lato + Playfair; A4 `@page`; header “Mohsin”, PHC REG, medical record uses `{{ $no }}` from Livewire slot; `{{ $slot }}` for body; footer staff grid + indigo address bar.
- **`invoices/noheader.blade.php`**: Roboto font; minimal top bar; `{{ $slot }}`; footer disclaimer + staff grid; commented duplicate address block.

### Print invoice

- **`invoices/show.blade.php`**: full HTML document with Vite; duplicate invoice blocks with “CUT FROM HERE”; `window.onload` setTimeout **print**; uses `asset('images/download.png')`.

---

## 11. Key Blade components and layouts

- **`layouts/app.blade.php`**, **`layouts/guest.blade.php`** — Breeze.
- **`components/layouts/app.blade.php`**, **`app1.blade.php`** — variants.
- **`App\View\Components\AppLayout`**, **`GuestLayout`** — map to those layouts.
- **`components/back-link.blade.php`**: wraps **slot** in `x-slot name="header"` for parent layout title + back link (used inside pages that supply header slot).
- **`x-filament-actions::modals`** on `newform-filament` for Filament form actions.

### Volt views

Located under `resources/views/livewire/pages/auth/` and `resources/views/livewire/profile/`; `resources/views/livewire/layout/navigation.blade.php`, `welcome/navigation.blade.php` — standard Breeze Volt structure.

---

## 12. Console and Octane

- **Octane** is a composer dependency; **no** `config/octane.php` in repo (publish if used). `public/frankenphp-worker.php` exists for FrankenPHP/Octane worker.

---

## 13. Public static assets (required for pixel fidelity)

- **`public/test_codes.json`** — content above.
- **Images** referenced: `public/images/download.png`, `public/images/download (1).png` (paths use `asset(...)`).
- **`public/build/*`** after `npm run build`; **`public/hot`** during Vite dev.

---

## 14. Tests

- **Pest** + Laravel `RefreshDatabase`; feature tests under `tests/Feature` for auth, profile, registration, etc. — **no** coverage of lab domain models.

---

## 15. Known inconsistencies (replicate or fix deliberately)

| Item | Detail |
|------|--------|
| Migrations | Domain tables absent from git; fresh migrate is insufficient. |
| `tests.cbc` view | Missing; `reportShow` route breaks. |
| `NewCase` | `dd()` in save; not the active new-case flow. |
| `AddResults` `save` | View passes test id argument; method signature has none. |
| `invoiceController` | Unused `Browsershot` import; package not required. |
| `TestResultResource` form | `patient_id` / relationship mismatch. |
| `routes/web.php` | Dead `use App\Livewire\LetterPad`. |
| Normal range gender | Code expects `all`; Filament manager only male/female. |
| `PatientEdit` mount | Parameter type `Patient $id` — unconventional binding name. |

---

## 16. File checklist — application code (copy tree)

**PHP application** (excluding `vendor/`):

- `app/Filament/Resources/**/*.php` (all Resources, Pages, RelationManagers)
- `app/Http/Controllers/**/*.php`
- `app/Livewire/**/*.php`
- `app/Models/*.php`
- `app/Providers/*.php` and `app/Providers/Filament/AdminPanelProvider.php`
- `app/View/Components/*.php`
- `bootstrap/app.php`, `bootstrap/providers.php`
- `config/*` (entire directory)
- `database/migrations/*`, `database/seeders/*`, `database/factories/*`
- `routes/web.php`, `routes/auth.php`, `routes/console.php`
- `resources/views/**` (entire tree)
- `resources/css/app.css`, `resources/js/app.js`
- `public/index.php`, `public/.htaccess`, `public/robots.txt`, `public/frankenphp-worker.php`, `public/test_codes.json`
- `vite.config.js`, `tailwind.config.js`, `postcss.config.js`, `package.json`, `composer.json`
- `tests/**`, `phpunit.xml` / `pest.php` if present

---

## 17. Environment (from `.env.example`)

- Standard Laravel 11 keys: `APP_*`, `LOG_*`, default **`DB_CONNECTION=sqlite`** with commented MySQL; `SESSION_*`, `QUEUE_*`, `CACHE_*`, `MAIL_*`, `VITE_APP_NAME`, etc.

---

## 18. Operational flow summary

1. Staff logs in (Breeze) → **Dashboard** card links to **New Case** (`/newcase/`).
2. **NewformFilament** creates **patient** + attaches **tests** → redirect to **Invoice** (`/invoice/{id}`).
3. **Invoice** lists tests with status from pivot `isResultAdded`; **Add Result** → **AddResults**; after save → back to invoice; **Edit** → **EditReport**; **Header** / **No Header** open reports in new tab using **patient_test** pivot id.
4. **Caselist** filters patients by date range and search; links to invoice and patient edit.
5. **Admin** users manage **Patients**, **Tests**, **Test fields**, **Test results** via Filament at `/admin`.

---

*Generated from repository snapshot. For line-perfect UI and behavior, diff against the actual Blade/PHP files after scaffolding Laravel + Breeze + Filament + Livewire versions above.*
