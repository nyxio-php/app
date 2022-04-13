<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = (new Nyxio\Config\Config())
    ->addConfig('dir', ['root' => __DIR__, 'config' => 'config'])
    ->preloadConfigs(['app', 'http', 'worker']);

date_default_timezone_set($config->get('app.timezone', 'UTC'));

$application = (new Nyxio\Kernel\Application(config: $config))->bootstrap();
$application->start();
