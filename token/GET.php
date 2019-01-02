<?php

function METHOD_GET($access_token) {
    $output = [];

    $output['expires'] = $access_token['expires'];
    $output['scope'] = $access_token['scope'];

    if ($output['expires'] <= time()) {
        response(false, 401, 'access_token_expired');
    }

    return $output;
}
