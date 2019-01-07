<?php

###############
# Output data #
###############

//Reponse to client
function response($success, $status_code = 200, $message = null, $extra = null)
{
    $output = ["success" => $success];

    if (isset($message) && !empty($message)) {
        if ($success) {
            $output = array_merge($output, ["message" => $message]);
        } else {
            $output = array_merge($output, ["error" => $message]);
        }
    }

    if (!empty($extra)) {
        $output = array_merge($output, $extra);
    }

    header('Content-Type: application/json');
    http_response_code($status_code);

    echo json_encode($output);
    exit;
}

function request($method, $url, $data = false, $headers = []) {
    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    if ($data) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    $response = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($response, true);
    return $response;
}
