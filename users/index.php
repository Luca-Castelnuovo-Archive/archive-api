<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

// access_token
authenticate_access($_REQUEST['access_token'], $_SERVER['Authorization'], 'api:mail');

// if user is empty query user from access_token

// else query public data from other users
