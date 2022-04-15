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
     * Providers
     */
    'providers' => [
        Kernel\Provider\KernelProvider::class,
        Kernel\Provider\ServerProvider::class,

        App\Provider\AppProvider::class,
    ],
];
