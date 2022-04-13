<?php

use App\Http\Action;

use function Nyxio\Helper\Env\env;

return [
    /**
     * Server settings
     */
    'server' => [
        'host' => env('SERVER_HOST', '127.0.0.1'),
        'port' => env('SERVER_PORT', 9501),
    ],

    /**
     * Allowed actions
     */
    'actions' => [
        Action\Hello::class,
    ],

    /**
     * Route groups
     */
    'groups' => [
        new \Nyxio\Routing\Group(name: 'api', prefix: '/api', parent: null),
    ],
];
