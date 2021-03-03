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

    'discord' => [    
        'client_id' => env('DISCORD_CLIENT_ID'),  
        'client_secret' => env('DISCORD_CLIENT_SECRET'),  
        'redirect' => env('DISCORD_REDIRECT_URI'),
    ],

    'google' => [    
        'client_id' => '1052492067172-32ral0b8mfor02k3f0lsnojaufhnbte9.apps.googleusercontent.com',  
        'client_secret' => 'QicKlBAkCm7SBJWBgcgMd5A3',  
        'redirect' => 'https://dev.marketsoft.io/google/callback' 
    ],
    'github' => [    
        'client_id' => 'bbc6c1014f3d204dcd05',  
        'client_secret' => '4ce8713e7eabd73924223c100ad7fcc320af106c',  
        'redirect' => 'https://dev.marketsoft.io/github/callback' 
    ],
];
