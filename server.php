<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = (new Nyxio\Config\Config())->addConfig('dir', ['root' => __DIR__, 'config' => 'config']);
$config->preload();

date_default_timezone_set($config->get('app.timezone', 'UTC'));

try {
    $application = (new Nyxio\Kernel\Application(config: $config))->bootstrap();
    $application->start();
} catch (Throwable $exception) {
    echo 'Error: ' . "\e[1m\033[91m" . $exception->getMessage() . "\033[0m" . \PHP_EOL;
}
