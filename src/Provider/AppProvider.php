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
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    public function process(): void
    {
        $this->eventListeners();
    }

    private function eventListeners(): void
    {
        $this->eventDispatcher->addListener(JobError::NAME, static function (JobError $event) {
            echo \sprintf(
                "Job \e[1m\033[91m%s\033[0m throw exception: %s" . \PHP_EOL,
                $event->job,
                $event->exception->getMessage()
            );
        });

        $this->eventDispatcher->addListener(JobCompleted::NAME, static function (JobCompleted $event) {
            echo \sprintf(
                "Job \e[1m\033[92m%s\033[0m completed" . \PHP_EOL,
                $event->job,
            );
        });

        $this->eventDispatcher->addListener(ResponseEvent::NAME, static function (ResponseEvent $event) {
            // listener
        });
    }
}
