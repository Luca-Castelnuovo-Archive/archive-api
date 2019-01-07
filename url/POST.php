<?php

function METHOD_POST($url) {
    $url = check_data($url, true, 'url', true);
    $data = [
        'url'      => $url,
        'format'   => 'json',
        'action'   => 'shorturl',
        'signature' => $GLOBALS['config']->services->url->signature
    ];

    $request = request('POST', 'https://url.lucacastelnuovo.nl/yourls-api.php', $data);

    if ($request['status'] !== 'success') {
        unset($request['status']);
        unset($request['url']);
        unset($request['title']);
        unset($request['code']);
        unset($request['statusCode']);
        $request['url'] = $request['shorturl'];
        $error = $request['message'];
        unset($request['shorturl']);
        unset($request['message']);
        response(false, 400, $error, $request);
    }

    $output['url'] = $request['shorturl'];

    return $output;
}
