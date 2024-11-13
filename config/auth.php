<?php

return [



    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],


    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'leader' => [
            'driver' => 'session',
            'provider' => 'leaders',
        ],
        'supervisor' => [
            'driver' => 'session',
            'provider' => 'supervisors',
        ],
    ],

   

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'leaders' => [
            'driver' => 'eloquent',
            'model' => App\Models\Leader::class,
        ],
        'supervisors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Supervisor::class,
        ],

      
    ],

  

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

  

    'password_timeout' => 10800,

];
