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
