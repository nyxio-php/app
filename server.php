<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = (new Nyxio\Config\Config())
    ->addConfig('dir', ['root' => __DIR__, 'config' => 'config'])
    ->preloadConfigs(['app', 'http', 'worker']);

date_default_timezone_set($config->get('app.timezone', 'UTC'));

echo "------------------------------\e[7mApplication settings\e[0m-------------------------------------------" . \PHP_EOL;
echo sprintf("* Debug mode: \e[1m%s\033[0m" . \PHP_EOL, $config->get('app.debug', false) ? "\033[31mYes" : "\033[32mNo");
echo sprintf("* Environments: \e[1m\033[32m%s\033[0m" . \PHP_EOL, $config->get('app.env', 'local'));
echo sprintf("* Timezone: \e[1m\033[32m%s\033[0m" . \PHP_EOL, $config->get('app.timezone', 'UTC'));
echo sprintf("* Loaded providers: \e[1m\033[32m%d\033[0m" . \PHP_EOL, count($config->get('app.providers', [])));
foreach ($config->get('app.providers', []) as $provider) {
    echo \sprintf(" - \e[1m\033[32m%s\033[0m" . \PHP_EOL, $provider);
}
echo sprintf("* Loaded http actions: \e[1m\033[32m%d\033[0m" . \PHP_EOL, count($config->get('http.actions', [])));
echo "---------------------------------------------------------------------------------------------" . \PHP_EOL;

$worker = (new \Workerman\Worker(
    \sprintf(
        'http://%s:%d',
        $config->get('worker.host', '0.0.0.0'),
        $config->get('worker.port', 8080)
    )
));

$worker->count = $config->get('worker.workers');
$worker->name = 'HTTP';

$worker->onWorkerStart = static function (\Workerman\Worker $worker) use ($config) {
    $application = (new Nyxio\Kernel\Application(config: $config))->bootstrap();

    $worker->onMessage = $application->request();
};
\Workerman\Worker::runAll();
