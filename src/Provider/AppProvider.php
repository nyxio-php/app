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
        $this->kernelEventListeners();
    }

    private function kernelEventListeners(): void
    {
        $this->eventDispatcher->addListener(
            Event\QueueException::NAME,
            static function (Event\QueueException $event) {
                echo \sprintf(
                    "[%s] Queue job \e[1m\033[91m%s\033[0m (%s) throw exception: %s" . \PHP_EOL,
                    (new \DateTime())->format('Y-m-d H:i:s'),
                    $event->taskData->job,
                    $event->taskData->uuid,
                    $event->exception->getMessage()
                );
            }
        );

        $this->eventDispatcher->addListener(
            Event\QueueComplete::NAME,
            static function (Event\QueueComplete $event) {
                echo \sprintf(
                    "[%s] Queue job \e[1m\033[92m%s\033[0m (%s) completed" . \PHP_EOL,
                    (new \DateTime())->format('Y-m-d H:i:s'),
                    $event->taskData->job,
                    $event->taskData->uuid,
                );
            }
        );

        $this->eventDispatcher->addListener(
            Event\ScheduleException::NAME,
            static function (Event\ScheduleException $event) {
                // handle
                echo \sprintf(
                    "[%s] Schedule job \e[1m\033[91m%s\033[0m throw exception at %s: %s" . \PHP_EOL,
                    (new \DateTime())->format('Y-m-d H:i:s'),
                    $event->taskData->job,
                    $event->exception->getMessage(),
                );
            }
        );

        $this->eventDispatcher->addListener(
            Event\ScheduleComplete::NAME,
            static function (Event\ScheduleComplete $event) {
                // handle
                echo \sprintf(
                    "[%s] Schedule job \e[1m\033[92m%s\033[0m completed" . \PHP_EOL,
                    (new \DateTime())->format('Y-m-d H:i:s'),
                    $event->taskData->job,
                );
            }
        );

        $this->eventDispatcher->addListener(Event\ResponseEvent::NAME, static function (Event\ResponseEvent $event) {
            // handle
        });
    }
}
