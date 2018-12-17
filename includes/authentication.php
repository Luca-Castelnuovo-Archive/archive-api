<?php

function authenticate_access($access_GET, $access_POST, $access_HEADER)
{
    if (empty($access_GET) && empty($access_POST) && empty($access_HEADER)) {
        response(false, 'bad_access_token');
    }

    $token_valid = true;
    if (!$token_valid) {
        response(false, 'bad_access_token');
    }
}
