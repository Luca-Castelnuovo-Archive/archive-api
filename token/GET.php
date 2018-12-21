<?php

function GET($access_token) {
    $output = [];

    $output['expires'] = $access_token['expires'];
    $output['scope'] = $access_token['scope'];

    if ($output['expires'] <= time()) {
        response(false, 'bad_access_token');
    }

    return $output;
}
