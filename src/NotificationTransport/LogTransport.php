<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\NotificationTransport;

use Dminustin\SystemNotifications\BaseClasses\BaseNotificationPayload;
use Dminustin\SystemNotifications\BaseClasses\BaseNotificationTransport;

class LogTransport extends BaseNotificationTransport
{
    public function send(BaseNotificationPayload $notification): bool
    {
        return true;
    }
}
