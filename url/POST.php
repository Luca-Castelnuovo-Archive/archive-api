<?php

function METHOD_POST($url, $keyword) {
    $url = check_data($url, true, 'url', true);
    $keyword = check_data($keyword, false, '', true);

    $data = [
        'url'      => $url,
        'keyword'  => $keyword,
        'format'   => 'json',
        'action'   => 'shorturl',
        'signature' => $username
    ];

    $request = request('POST', 'http://url.lucacastelnuovo.nl/yourls-api.php', $data);

    if (!$request['status']) {
        response(false, 405, 'request_failed');
    }

    $output['url'] = $request['shorturl'];

    return $output;
}
