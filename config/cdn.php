<?php

return [

    'base_url' => 'http//localhost:8000',

    'client_id' => 1,
    'client_secret' => 'k9McVVFPhlL2JywqyicSJvv5VrFGuOSfkUF6biiy',

    'username' => 'maksim.babichev95@gmail.com',
    'password' => 'tugQweZd',

    'buckets' => [

        'wheels' => [
            'xs' => [
                'type' => 'fit',
                'width' => 250,
                'height' => 250,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            'm' => [
                'type' => 'fit',
                'width' => 500,
                'height' => 500,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            'xl' => [
                'type' => 'fit',
                'width' => 1000,
                'height' => 1000,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
        ],

        'brands' => [
            'xs' => [
                'type' => 'contain',
                'width' => 250,
                'height' => 250,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            'm' => [
                'type' => 'contain',
                'width' => 500,
                'height' => 500,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            'xl' => [
                'type' => 'contain',
                'width' => 1000,
                'height' => 1000,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
        ],

        'users' => [
            'xs' => [
                'type' => 'cover',
                'width' => 150,
                'height' => 150,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            'm' => [
                'type' => 'cover',
                'width' => 300,
                'height' => 300,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
            'xl' => [
                'type' => 'cover',
                'width' => 600,
                'height' => 600,
                'quality' => 75,
                'color' => 'rgba(0,0,0,0)',
            ],
        ],

    ],

];
