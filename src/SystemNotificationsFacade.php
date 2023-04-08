<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dminustin\SystemNotifications\Skeleton\SystemNotificationsSkeletonClass
 */
class SystemNotificationsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'system-notifications';
    }
}
