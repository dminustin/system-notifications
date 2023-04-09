<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\Enums;

enum NotificationLevelEnum: string
{
    case LOG_LEVEL_INFO = 'info';

    case LOG_LEVEL_WARNING = 'warning';

    case LOG_LEVEL_ERROR = 'error';

    case LOG_LEVEL_CRITICAL = 'critical';

    case LOG_LEVEL_ALERT = 'alert';

    case LOG_LEVEL_EMERGENCY = 'emergency';

    case LOG_LEVEL_NOTICE = 'notice';

    case LOG_LEVEL_DEBUG = 'debug';

    case LOG_LEVEL_SUCCESS = 'success';
}
