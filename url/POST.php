<?php

function METHOD_POST($url, $keyword) {
    $url = check_data($url, true, 'url', true);
    $keyword = check_data($keyword, false, '', true);

    $data = [
        'url'      => $url,
        'keyword'  => $keyword,
        'format'   => 'json',
        'action'   => 'shorturl',
        'signature' => $GLOBALS['config']->services->url->signature
    ];

    $request = request('POST', 'https://url.lucacastelnuovo.nl/yourls-api.php', $data);

    if ($request['status'] !== 'success') {
        unset($request['status']);
        unset($request['url']);
        unset($request['title']);
        unset($request['statusCode']);
        response(false, 400, 'request_failed', $request);
    }

    $output['url'] = $request['shorturl'];

    return $output;
}
