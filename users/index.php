<?php

require $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';

// access_token
auth($_GET['access_token'], $_POST['access_token'], $_SERVER['Authorization']);

// if user is empty query user from access_token

// else query public data from other users
