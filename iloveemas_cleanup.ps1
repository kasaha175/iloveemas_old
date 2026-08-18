<#
.SYNOPSIS
  Phase 1 repo hygiene cleanup for iloveemas_apps.

.DESCRIPTION
  Moves legacy backup/zip/dump files (confirmed superseded - see
  README_CLEANUP_PHASE1.md for the evidence) out of the active source
  tree and into _archive_legacy_backups/, using `git mv` where possible
  so the history stays clean.

  This script does NOT delete anything and does NOT commit anything.
  Review the results with `git status` / `git diff --stat` and commit
  yourself when you're happy.

.NOTES
  Run this from the project root, e.g.:
    cd F:\laragon\www\iloveemas_apps
    powershell -ExecutionPolicy Bypass -File .\iloveemas_cleanup.ps1
#>

$ErrorActionPreference = "Continue"

$root = Get-Location
$archive = Join-Path $root "_archive_legacy_backups"

if (-not (Test-Path $archive)) {
    New-Item -ItemType Directory -Path $archive | Out-Null
    Write-Host "Created $archive"
}

# Confirmed-superseded files (see README_CLEANUP_PHASE1.md):
#  - controller backups: function sets are strict subsets of the current file
#  - routes15072025.php: every route in it also exists in routes.php
#  - the .zip files: dated snapshots (2019-2022) of controllers/views, fully
#    superseded by what's in application/ now
#  - db_ilovemas*.sql: local DB dumps, shouldn't be in source control at all
#  - error_log / cookies.txt: runtime/debug artifacts, not source
$targets = @(
    "application\application.zip",
    "application\mvc new.zip",
    "application\controllers\controller.zip",
    "application\controllers\TransactionController15072025.php",
    "application\controllers\TransactionControllerBackup.php",
    "application\config\routes15072025.php",
    "application\models\s.vb",
    "application\db_ilovemas - local.sql",
    "application\db_ilovemas - new local.sql",
    "error_log",
    "cookies.txt"
)

foreach ($t in $targets) {
    if (Test-Path -LiteralPath $t) {
        $dest = Join-Path $archive (Split-Path $t -Leaf)
        Write-Host "Archiving: $t -> $dest"
        git mv -- "$t" "$dest" 2>$null
        if ($LASTEXITCODE -ne 0) {
            Move-Item -LiteralPath $t -Destination $dest -Force
        }
    } else {
        Write-Host "Skip (not found): $t"
    }
}

Write-Host ""
Write-Host "Done. Next steps:"
Write-Host "  1. git status                 # review what moved"
Write-Host "  2. git add -A"
Write-Host "  3. git commit -m `"chore: archive legacy backup/zip/dump files (phase 1 cleanup)`""
Write-Host ""
Write-Host "Note: this only cleans the WORKING TREE going forward. The old files"
Write-Host "still exist in git history. If you plan to hand this repo to a buyer's"
Write-Host "technical due-diligence team, that history (including the local SQL"
Write-Host "dumps, which may contain real customer data) should be scrubbed first -"
Write-Host "ask about this before sharing the repo externally."
