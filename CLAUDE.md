# iloveemas_apps - Project Memory

## What this is
Internal system (CodeIgniter/PHP) for a precious-metals ("logam mulia") trading
business: branch (cabang) management, customer master, buy/sell transactions,
price-per-gram calculation by purity (kadar) for gold/tantalum/etc., legal &
contract workflow with multi-level approval (PIC -> legal verifikasi -> legal
drafting -> legal review -> komite 1-3 -> direktur), reporting, Telegram bot
notifications.

## Business goal (owner's plan)
Currently used by exactly 1 client (a precious-metals company). Owner wants to
productize this and sell it to other companies with similar business, on
"latest technology". Chosen direction (as of this session):
- Business model: phased - start as licensed/white-label per-client deployment
  (own DB/instance per client, config-driven branding & business rules),
  evolve to true multi-tenant SaaS later once the codebase is modular enough.
- Tech approach: incremental modernization, NOT a full rewrite.

See full B2B + technical readiness recommendations given in chat on
2026-08-18 (business model options, legal/IP checklist, pricing, GTM,
compliance notes re: PPATK/AML for precious-metals dealers, and the technical
checklist below) - not reproduced here, ask the owner if it needs to be
regenerated.

## Tech stack
- PHP CodeIgniter, old version (composer.json requires PHP >=5.3.7 - not yet
  upgraded as of this session).
- phpoffice/phpspreadsheet for Excel export.
- Docker + docker-compose present. CI/CD: .github/workflows/deploy.yml exists.
- No test framework in place yet.
- No multi-tenancy in the data model yet (single DB per install).

## Known architecture debt (found during Phase 1 audit)
- MasterController.php and TransactionController.php are very large
  (83KB / 78KB) - mix many responsibilities, candidates for refactor into
  smaller per-domain controllers (pricing, cabang, customer, transaksi,
  kontrak) before multi-tenant work starts.
- History of "versioning by duplicate file" instead of git branches:
  TransactionControllerBackup.php, TransactionController15072025.php,
  routes15072025.php, plus several .zip snapshots. Confirmed via function-set
  diff that all of these are strict subsets of the current files - safe to
  archive (done in Phase 1, see below).
- No .env / secrets separation existed before Phase 1 (DB credentials were
  hardcoded in application/config/database.php).

## Progress log
- **2026-08-18 - Phase 1 (repo hygiene) completed by Claude:**
  - Added `.gitignore` (was missing entirely before this).
  - Added `.env.example` + `application/config/database.env-ready.php`
    (drop-in replacement for database.php that reads DB_HOST/DB_USERNAME/
    DB_PASSWORD/DB_DATABASE from a project-root `.env`, falling back to the
    existing local defaults so nothing breaks if `.env` is absent). **Not
    yet applied** - owner needs to review and manually rename it to
    database.php when ready (instructions in the file itself and in
    README_CLEANUP_PHASE1.md).
  - Added `iloveemas_cleanup.ps1` - moves confirmed-superseded backup/zip/
    SQL-dump/log files into `_archive_legacy_backups/` via `git mv`. Does
    NOT delete or auto-commit - owner runs it and commits manually.
  - Flagged but NOT resolved (needs the owner, not something Claude can do):
    verify who owns the IP/source code rights given the app was likely built
    for the first client - check the original contract before selling to
    competitors of that client.

## Next steps (not yet started)
- Phase 2: upgrade PHP + CodeIgniter to a supported version; refactor
  MasterController/TransactionController into smaller modules; build the
  config layer so a new client deployment = new config, not a code fork;
  prepare sanitized demo data + sales/contract materials.
- Phase 3: design + migrate to real multi-tenant architecture once 2-3
  clients are live and the codebase is modular.
- Before sharing this repo with any external party (buyer's technical
  due-diligence): scrub git history of the SQL dumps / backup files, not
  just the working tree (moving files forward doesn't remove them from
  history).

## Commands
- No test suite configured yet.
- Dependencies: `composer install` (requires PHP >=5.3.7 currently).
