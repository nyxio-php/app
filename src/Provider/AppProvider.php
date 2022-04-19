<?php

declare(strict_types=1);

namespace App\Provider;

use Nyxio\Contract\Event\EventDispatcherInterface;
use Nyxio\Contract\Provider\ProviderInterface;
use Nyxio\Kernel\Event\JobCompleted;
use Nyxio\Kernel\Event\JobError;
use Nyxio\Kernel\Event\ResponseEvent;

class AppProvider implements ProviderInterface
{
    public function __construct(private readonly EventDispatcherInterface $dispatcher)
    {
    }

    public function process(): void
    {
        // process
        $this->eventListeners();
    }

    private function eventListeners(): void
    {
        $this->dispatcher->addListener(JobError::NAME, static function (JobError $event) {
            echo \sprintf(
                "Job error (%s): \e[1m\033[91m%s\033[0m" . \PHP_EOL,
                $event->job,
                $event->exception->getMessage()
            );
        });

        $this->dispatcher->addListener(JobCompleted::NAME, static function (JobCompleted $event) {
            echo \sprintf(
                "Job completed – \e[1m\033[92m%s\033[0m" . \PHP_EOL,
                $event->job,
            );
        });

        $this->dispatcher->addListener(ResponseEvent::NAME, static function (ResponseEvent $event) {
            // listener
        });
    }
}
