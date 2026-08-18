# Phase 1 cleanup - what Claude did and why

Generated 2026-08-18, as the first step of the "productize & sell to other
precious-metals companies" plan. This only touches repo hygiene and config -
no business logic was changed, and nothing was overwritten in your live
`application/config/database.php`.

## Files added directly to your project (already committed to disk, not yet to git)
- `.gitignore` - your repo had none before. Covers `.env`, CodeIgniter
  cache/logs, the backup-file naming patterns found in this repo (e.g.
  `*Backup.php`, `*15072025.php`), `*.zip`, `*.sql`, `error_log`,
  `cookies.txt`.
- `.env.example` - template for DB credentials. Copy to `.env` and fill in
  real values when you're ready (not created automatically - see below).
- `application/config/database.env-ready.php` - a ready-to-use replacement
  for `database.php` that reads DB settings from `.env` instead of having
  them hardcoded, with a safe fallback to today's local values. **Left as a
  separate file on purpose** - your current `database.php` only has local
  dev defaults (127.0.0.1 / root / no password) so there's no secret to hide
  yet, but this is the pattern to use per-client once you're deploying to
  real client servers. Apply it when you're ready (steps are in the file's
  header comment).
- `iloveemas_cleanup.ps1` - run this yourself from the project root in
  PowerShell. It moves the files below into `_archive_legacy_backups/` using
  `git mv`, then tells you to review with `git status` and commit. It does
  **not** delete anything and does **not** commit for you.

## Files the cleanup script will archive (evidence checked before recommending this)
| File | Why it's safe to archive |
|---|---|
| `application/controllers/TransactionControllerBackup.php` | Function-set diff shows every function in it also exists in the current `TransactionController.php` - nothing unique. |
| `application/controllers/TransactionController15072025.php` | Same - strict subset of the current controller. |
| `application/config/routes15072025.php` | Line-by-line diff shows every route in it also exists in the current `routes.php`, plus current file has ~20 more routes this one lacks. |
| `application/application.zip` | Dated 2019-2022 snapshot of controllers/views, superseded by current `application/` folder. |
| `application/mvc new.zip` | Same kind of dated snapshot. |
| `application/controllers/controller.zip` | Contains a single old `TransactionController.php` from Dec 2020. |
| `application/models/s.vb` | Empty (0 bytes) stray file. |
| `application/db_ilovemas - local.sql`, `application/db_ilovemas - new local.sql` | Local DB dumps - these don't belong in source control at all (size + possible real customer/transaction data). |
| `error_log`, `cookies.txt` | Runtime/debug artifacts, not source. |

## What you need to do
1. Copy these 5 files into `F:\laragon\www\iloveemas_apps` (same relative
   paths) - Claude has already written the ones that are 100% safe (`.gitignore`,
   `.env.example`, `database.env-ready.php`, `iloveemas_cleanup.ps1`,
   `CLAUDE.md`) directly onto your machine, so you may already have them.
2. Run `iloveemas_cleanup.ps1` from the project root, review `git status`,
   commit when happy.
3. When ready, review `application/config/database.env-ready.php`, create a
   real `.env` from `.env.example`, and swap it in for `database.php`.
4. Separately (not something Claude can verify for you): check your original
   contract/SOW with the first client to confirm you own the IP and are free
   to resell to their competitors. This should happen before you invest
   further in productizing.

## Not done yet (flagged as bigger, separate work)
PHP/CodeIgniter version upgrade, refactoring `MasterController.php` /
`TransactionController.php` into smaller modules, the per-client config
layer, and multi-tenant architecture design - these need their own scoping
session since they touch logic that's actively serving your paying client
and shouldn't be rushed. See `CLAUDE.md` "Next steps" for the plan.
