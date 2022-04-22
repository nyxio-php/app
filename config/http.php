<?php

use App\Http\Action;

return [
    /**
     * Allowed actions
     */
    'actions' => [
        Action\Home::class,
    ],

    /**
     * Route groups
     */
    'groups' => [
        new \Nyxio\Routing\Group(name: 'api', prefix: '/api', parent: null),
    ],
];
