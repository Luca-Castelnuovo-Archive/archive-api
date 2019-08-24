<?php

require_once __DIR__ . '/../vendor/autoload.php';

$GLOBALS['config'] = require $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/includes/authentication.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/output.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/security.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php';

// External
require '/var/www/logs.lucacastelnuovo.nl/public_html/logs.php';
