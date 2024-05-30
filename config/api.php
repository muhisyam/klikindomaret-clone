<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | API for fecting data. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('API_URL', 'http://127.0.0.1:8080/api/'),
    
    /*
    |--------------------------------------------------------------------------
    | API PORT
    |--------------------------------------------------------------------------
    |
    | This port is used in the api endpoint, which will differentiate the port 
    | used in the application so that conflicts do not occur.
    |
    */

    'port' => env('API_PORT', ':8080'),
    
];