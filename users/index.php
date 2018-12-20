<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

// $access_token = authenticate_access($_REQUEST['access_token'], $_SERVER['Authorization']);

// $user = sql_select('users', '*', "id='{$access_token['user_id']}'", true);
$user = sql_select('users', '*', "id='12'", true);


print_r($user);
response(true, 'access_granted', ['user' => $user]);
