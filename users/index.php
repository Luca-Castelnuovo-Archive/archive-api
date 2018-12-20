<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

$access_token = authenticate_access($_REQUEST['access_token'], $_SERVER['Authorization'], 'api:mail');

$access = sql_select('users', '*', "id='{$access_token['user_id']}'", true);

response(true, 'access_granted', $access);
