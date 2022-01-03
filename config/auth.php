<?php

return [
    // 'defaults' => [
    //     'guard' => 'admin',
    //     'passwords' => 'admins',
    // ],

    'guards' => [
        'admin' => [
            'driver' => 'jwt',
            'provider' => 'admins',
        ],
        'seller' => [
            'driver' => 'jwt',
            'provider' => 'sellers',
        ],
        'buyer' => [
            'driver' => 'jwt',
            'provider' => 'buyers',
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Admin::class
        ],
        'sellers' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Seller::class
        ],
        'buyers' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Buyer::class
        ],
    ]
];
