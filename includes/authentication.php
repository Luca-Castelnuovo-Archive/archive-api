<?php

function authenticate_access($access_GET, $access_POST, $access_HEADER, $required_scope = null)
{
    if (empty($access_GET) && empty($access_POST) && empty($access_HEADER)) {
        response(false, 'bad_access_token');
    }

    //validate token
    $token_valid = true;

    //validate expires

    if (!$token_valid) {
        response(false, 'bad_access_token');
    }
}
