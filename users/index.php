<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = authenticate_access($_REQUEST['access_token'], $_SERVER['Authorization']);

$access = sql_select('users', '*', "id='{$access_token['user_id']}'", true);

print_r($access);

response(true, 'access_granted', ['user' => $access]);
