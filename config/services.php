<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '1075164089585-ptsp31m2mqlomn8n49logh3jd6aiklui.apps.googleusercontent.com',
        'client_secret' => 'Y1Qg32mTIUyCahN0shvpSKOY',
        'redirect' => 'https://zapwallet.in/callback/google',
      ],
    'linkedin' => [
        'client_id' => '81jsc2px1xrknh',
        'client_secret' => '7Gwodkw584SITSdT',
        'redirect' => 'https://zapwallet.in/callback/linkedin',
      ],
    'facebook' => [
        'client_id' => '1699947766995966',
        'client_secret' => 'b335b9e1487bd73dd48f929245c792e0',
        'redirect' => 'https://www.tellifone.com/facebook2oauth/',
      ],
];
