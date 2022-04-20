<?php

declare(strict_types=1);

namespace App\Provider;

use Nyxio\Contract\Event\EventDispatcherInterface;
use Nyxio\Contract\Provider\ProviderInterface;
use Nyxio\Kernel\Event;

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
        $this->eventDispatcher->addListener(Event\JobError::NAME, function (Event\JobError $event) {
            echo \sprintf(
                "Job \e[1m\033[91m%s\033[0m throw exception: %s" . \PHP_EOL,
                $event->job,
                $event->exception->getMessage()
            );
        });

        $this->eventDispatcher->addListener(Event\JobCompleted::NAME, function (Event\JobCompleted $event) {
            echo \sprintf(
                "Job \e[1m\033[92m%s\033[0m completed" . \PHP_EOL,
                $event->job,
            );
        });

        $this->eventDispatcher->addListener(Event\CronJobError::NAME, function (Event\CronJobError $event) {
            // handle
        });

        $this->eventDispatcher->addListener(Event\CronJobCompleted::NAME, function (Event\CronJobCompleted $event) {
            // handle
        }
        );

        $this->eventDispatcher->addListener(Event\ResponseEvent::NAME, function (Event\ResponseEvent $event) {
            // handle
        });
    }
}
