<?php

function METHOD_GET($access_token)
{
    $output = [];

    $output['expires'] = $access_token['expires'];
    $output['scope'] = $access_token['scope'];

    if ($output['expires'] <= time()) {
        response(false, 401, 'access_token_expired');
    }

    log_action('1', 'token.info', $_SERVER["REMOTE_ADDR"], $access_token['user_id'], $access_token['client_id']);
    return $output;
}
