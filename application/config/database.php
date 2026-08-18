<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS (env-aware version)
| -------------------------------------------------------------------
| Drop-in replacement for application/config/database.php.
|
| This reads DB_HOST / DB_USERNAME / DB_PASSWORD / DB_DATABASE from a
| ".env" file at the project root when present, and falls back to the
| same local defaults the original file used, so nothing breaks if
| ".env" is missing.
|
| HOW TO APPLY (do this yourself after reviewing):
|   1. Rename the current application/config/database.php to
|      database.local-backup.php (keep it until you've verified this
|      works).
|   2. Rename this file (database.env-ready.php) to database.php.
|   3. Copy .env.example to .env at the project root and fill in the
|      real values for whichever environment you're deploying to.
|   4. Load a page and confirm the app still connects correctly.
|
| For each future client install, they just get their own .env with
| their own DB_* values - no code changes needed per client.
| -------------------------------------------------------------------
*/

if (!function_exists('ilm_load_env')) {
	function ilm_load_env($path)
	{
		if (!is_readable($path)) {
			return;
		}
		foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
			$line = trim($line);
			if ($line === '' || strpos($line, '#') === 0 || strpos($line, '=') === false) {
				continue;
			}
			list($key, $value) = explode('=', $line, 2);
			$key = trim($key);
			$value = trim($value);
			$len = strlen($value);
			if ($len >= 2 && (($value[0] === '"' && $value[$len - 1] === '"') || ($value[0] === "'" && $value[$len - 1] === "'"))) {
				$value = substr($value, 1, -1);
			}
			if (getenv($key) === false) {
				putenv("$key=$value");
				$_ENV[$key] = $value;
			}
		}
	}
}

if (!function_exists('ilm_env')) {
	function ilm_env($key, $default = null)
	{
		$value = getenv($key);
		return ($value === false) ? $default : $value;
	}
}

// project root is one level up from application/config/
ilm_load_env(APPPATH . '../.env');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => ilm_env('DB_HOST', '127.0.0.1'),
	'username' => ilm_env('DB_USERNAME', 'root'),
	'password' => ilm_env('DB_PASSWORD', ''),
	'database' => ilm_env('DB_DATABASE', 'db_ilovemas'),
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
