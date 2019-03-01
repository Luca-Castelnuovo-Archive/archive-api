<?php

function METHOD_POST($url, $client_id)
{
    $url = check_data($url, true, 'url', true);
    $data = [
        'url'      => $url,
        'format'   => 'json',
        'action'   => 'shorturl',
        'signature' => $GLOBALS['config']->services->url->signature
    ];

    $request = request('POST', 'https://url.lucacastelnuovo.nl/yourls-api.php', $data);

    if ($request['status'] !== 'success' && !strpos($request['message'], 'already exists in database') !== false) {
        unset($request['status']);
        unset($request['url']);
        unset($request['title']);
        unset($request['code']);
        unset($request['statusCode']);
        $output['url'] = 'http://l1c.me/' . explode('/', $request['shorturl'])[3];
        $output['long_url'] = $url;
        $error = $request['message'];
        unset($request['shorturl']);
        unset($request['message']);
        response(false, 400, $error, $request);
    }

    $output['url'] = 'http://l1c.me/' . explode('/', $request['shorturl'])[3];
    $output['long_url'] = $url;
    $output['message'] = $request['message'];

    log_action('1', 'url.created', $_SERVER["REMOTE_ADDR"], '', $client_id);
    return $output;
}
