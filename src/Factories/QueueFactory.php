<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\Factories;

use Dminustin\SystemNotifications\BaseClasses\BaseQueue;
use Dminustin\SystemNotifications\Queue\RedisQueue;

class QueueFactory
{
    public function getQueue(): BaseQueue
    {
        return new RedisQueue();
    }
}
