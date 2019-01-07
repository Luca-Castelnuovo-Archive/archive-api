<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = validate_access('message');

require 'POST.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $output = METHOD_GET($_POST['user_id'], $_POST['message']);
        break;

    default:
        response(false, 405, 'method_not_allowed');
        break;
}

response(true, 200, '', $output);
