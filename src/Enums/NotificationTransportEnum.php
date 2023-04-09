<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\Enums;

use Dminustin\SystemNotifications\NotificationTransport\LogTransport;
use Dminustin\SystemNotifications\NotificationTransport\SlackTransport;

enum NotificationTransportEnum: string
{
    case TRANSPORT_SLACK = 'slack';

//    case TRANSPORT_TELEGRAM = 'telegram';

//    case TRANSPORT_EMAIL = 'email';

//    case TRANSPORT_SMS ='sms';

    case TRANSPORT_LOG = 'log';

//    case TRANSPORT_SENTRY = 'sentry';

    public function getTransportClass(): ?string
    {
        return match ($this->value) {
            self::TRANSPORT_SLACK->value => SlackTransport::class,
            self::TRANSPORT_LOG->value => LogTransport::class,
            default => null,
        };
    }
}
