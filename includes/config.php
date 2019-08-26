<?php

$configKey = getenv('CONFIG_KEY');
$configClient = new \ConfigCat\ConfigCatClient($configKey);

if (!$configClient->getValue("appActive", false)) {
    http_response_code(503);
    exit('App is temporarily disabled.');
}

return (object) array(
    'database' => (object) array(
        'host' => $configClient->getValue("dbHost", "localhost"),
        'user' => $configClient->getValue("dbUser", ""),
        'password' => $configClient->getValue("dbPassword", ""),
        'database' => $configClient->getValue("dbDatabase", ""),
    ),

    'auth' => (object) array(
        'client_id' => $configClient->getValue("clientID", ""),
        'client_secret' => $configClient->getValue("clientSecret", ""),
    ),

    'services' => (object) array(
        'mail' => (object) array(
            'Host' => $configClient->getValue("mailHost", ""),
            'SMTPAuth' => $configClient->getValue("mailSMTPAuth", true),
            'Username' => $configClient->getValue("mailUsername", ""),
            'Password' => $configClient->getValue("mailPassword", ""),
            'SMTPSecure' => $configClient->getValue("mailSMTPSecure", "ssl"),
            'Port' => $configClient->getValue("mailPort", 465),
            'From' => $configClient->getValue("mailFrom", ""),
        ),
        'recaptcha' => (object) array(
            'secret_key' => $configClient->getValue("recaptchaSecretKey", ""),
        ),
        'url' => (object) array(
            'signature' => $configClient->getValue("urlSignature", ""),
        ),
    ),
);

