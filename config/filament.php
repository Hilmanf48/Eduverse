<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Filament Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Filament will be accessible from.
    | You can change it to any path you prefer.
    |
    */

    'path' => 'admin', // Maka panel bisa diakses di http://localhost:8000/admin

    /*
    |--------------------------------------------------------------------------
    | Filament Middleware
    |--------------------------------------------------------------------------
    |
    | These are the middleware that will be assigned to every Filament request.
    | Typically, you'll want to include the "web" and "auth" middleware.
    |
    */

    'middleware' => [
        'web',
        'auth',
    ],

    /*
    |--------------------------------------------------------------------------
    | Auth Guard
    |--------------------------------------------------------------------------
    |
    | This is the name of the authentication guard used by Filament.
    |
    */

    'auth' => [
        'guard' => 'web',
    ],

];
