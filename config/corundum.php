<?php

return [

    'client_credentials' => \Bavix\CupKit\ClientCredentials::class,
    'identity' => \Bavix\CupKit\Identity::class,
    'client' => \Bavix\CupKit\Client::class,

    'base_url' => env('CDN_BASE_URL'),

    'client_id' => env('CDN_CLIENT_ID'),
    'client_secret' => env('CDN_SECRET'),

    'username' => env('CDN_USERNAME'),
    'password' => env('CDN_PASSWORD'),

    'buckets' => [

        'wheels' => [
            [
                'name' => 'xs',
                'type' => 'fit',
                'width' => 250,
                'height' => 250,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            [
                'name' => 'm',
                'type' => 'fit',
                'width' => 500,
                'height' => 500,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            [
                'name' => 'xl',
                'type' => 'fit',
                'width' => 1000,
                'height' => 1000,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
        ],

        'brands' => [
            [
                'name' => 'xs',
                'type' => 'contain',
                'width' => 250,
                'height' => 250,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            [
                'name' => 'm',
                'type' => 'contain',
                'width' => 500,
                'height' => 500,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            [
                'name' => 'xl',
                'type' => 'contain',
                'width' => 1000,
                'height' => 1000,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
        ],

        'users' => [
            [
                'name' => 'xs',
                'type' => 'cover',
                'width' => 150,
                'height' => 150,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            [
                'name' => 'm',
                'type' => 'cover',
                'width' => 300,
                'height' => 300,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            [
                'name' => 'xl',
                'type' => 'cover',
                'width' => 600,
                'height' => 600,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
        ],

    ],

];
