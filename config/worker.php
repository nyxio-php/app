<?php

use function Nyxio\Helper\Env\env;

// Config for workerman server https://github.com/walkor/workerman
return [
    'host' => env('SERVER_HOST', '0.0.0.0'),
    'port' => env('SERVER_PORT', 8080),
    'workers' => env('SERVER_WORKERS', 6),
];
