<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = validate_access('client_credentials');

require 'POST.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $output = METHOD_POST($_POST['url'], $access_token['client_id']);
        break;

    default:
        response(false, 405, 'method_not_allowed');
        break;
}

response(true, 200, '', $output);
