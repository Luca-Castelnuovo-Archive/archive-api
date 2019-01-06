<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = validate_access('basic:read');

require 'GET.php';
require 'PUT.php';
require 'DELETE.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $output = METHOD_GET($access_token['scope'], $access_token['user_id']);
        break;

    case 'PUT':
        $output = METHOD_PUT($access_token['scope'], $access_token['user_id']);
        break;

    case 'DELETE':
        $output = METHOD_DELETE($access_token['scope'], $access_token['user_id']);
        break;

    default:
        response(false, 405, 'method_not_allowed');
        break;
}

response(true, 200, '', $output);
