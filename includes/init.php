<?php

$GLOBALS['config'] = require $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

require $_SERVER['DOCUMENT_ROOT'] . '/includes/authentication.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/output.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/security.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/sql.php';

// External
require '/var/www/logs.lucacastelnuovo.nl/public_html/logs.php';

if (function_exists('log_action')) {
    response(true);
} else {
    response(false);
}

log_action('1', 'service.test', $_SERVER["REMOTE_ADDR"], 'USER_ID', 'CLIENT_ID');
