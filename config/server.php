<?php

use function Nyxio\Helper\Env\env;

return [
    /**
     * Server settings
     */
    'host' => env('SERVER_HOST', '127.0.0.1'),
    'port' => env('SERVER_PORT', 9501),
    'options' => [ // OpenSwoole options
        'worker_num' => env('SERVER_OPTION_WORKER_NUM', 4),
        'task_worker_num' => env('SERVER_OPTION_TASK_WORKER_NUM', 4), // for Queue
    ],
];
