<?php

use App\Http\Action;

return [
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
        new \Nyxio\Routing\Group('api', prefix: '/api'),
    ],
];
