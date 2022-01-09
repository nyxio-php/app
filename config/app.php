<?php

use Nyxio\Kernel;

use function Nyxio\Helper\Env\env;

return [
    /**
     * Application common
     */
    'env' => env('APP_ENV', 'local'),
    'debug' => env('APP_DEBUG', true),
    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /**
     * Application directories
     */
    'path' => [
        'public' => '/public',
    ],

    /**
     * Providers
     */
    'providers' => [
        Kernel\Provider\KernelProvider::class,
        Kernel\Provider\WorkermanProvider::class,

        App\Provider\AppProvider::class,
    ],
];
