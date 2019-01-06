<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = validate_access();

require 'GET.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $output = METHOD_GET($access_token);
        break;

    default:
        response(false, 405, 'method_not_allowed');
        break;
}

response(true, 200, '', $output);
