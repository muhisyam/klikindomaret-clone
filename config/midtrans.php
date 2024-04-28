<?php 

return [

    /*
    |--------------------------------------------------------------------------
    | Midtrans Payment Gateway
    |--------------------------------------------------------------------------
    |
    | Id is identity app to communicate with Midtrans api service.
    |
    */

    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Client Key
    |--------------------------------------------------------------------------
    |
    | An api key authorization using on frontend api request. For snaping 
    | purposes to get client payment gateway information. Safe to 
    | display publicly.
    |
    */

    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    
    /*
    |--------------------------------------------------------------------------
    | Server Key
    |--------------------------------------------------------------------------
    |
    | An api key authorization using while calling Midtrans api from backend. 
    | Keep safe it confidential.
    |
    */

    'server_key' => env('MIDTRANS_SERVER_KEY'),
    
    /*
    |--------------------------------------------------------------------------
    | Midtrans Endpoint
    |--------------------------------------------------------------------------
    |
    | This endpoint that used to access midtrans payment API for any purposes
    | like get token, cancel, refund payment etc.
    |
    */

    'endpoint' => env('MIDTRANS_API_URL', 'https://api.sandbox.midtrans.com/v2/'),
    
    /*
    |--------------------------------------------------------------------------
    | Midtrans URL
    |--------------------------------------------------------------------------
    |
    | This URL refers to your midtrans application environment that currently
    | running. Sandbox or production.
    |
    */

    'url' => env('MIDTRANS_APP_URL', 'https://app.sandbox.midtrans.com/'),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your midtrans application 
    | is currently running in. This will cause several configurations 
    | to be adjusted.
    |
    */

    'env' => env('MIDTRANS_ENV', false),
    
    /*
    |--------------------------------------------------------------------------
    | Sanitization
    |--------------------------------------------------------------------------
    |
    | This value to sanitizing merchant transaction.
    |
    */

    'sanitized' => env('MIDTRANS_SANITIZED', true),
    
    /*
    |--------------------------------------------------------------------------
    | Three Domain Secure
    |--------------------------------------------------------------------------
    |
    | This value will allow the application to make transactions using 
    | a credit card then make transaction more securely. According to the guide:
    | https://github.com/Midtrans/midtrans-php?tab=readme-ov-file#21-general-settings
    |
    */

    '3ds' => env('MIDTRANS_3DS', true),
    
];