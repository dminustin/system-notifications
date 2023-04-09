<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\BaseClasses;

abstract class BaseQueue
{
    abstract public function put($queue, BaseNotificationPayload $payload): bool;

    abstract public function get($queue): ?BaseNotificationPayload;
}
