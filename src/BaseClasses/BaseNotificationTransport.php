<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\BaseClasses;

abstract class BaseNotificationTransport
{
    abstract public function send(BaseNotificationPayload $notification): bool;
}
