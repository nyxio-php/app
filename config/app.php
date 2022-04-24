<?php

use Nyxio\Kernel;

use function Nyxio\Helper\Env\env;

return [
    /**
     * Application settings
     */
    'env' => env('APP_ENV', 'local'),
    'debug' => env('APP_DEBUG', false),
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'lang' => env('APP_LANG', 'en'),

    /**
     * Providers
     */
    'providers' => [
        Kernel\Provider\KernelProvider::class,
        Kernel\Provider\ServerProvider::class,

        App\Provider\AppProvider::class,
    ],
];
