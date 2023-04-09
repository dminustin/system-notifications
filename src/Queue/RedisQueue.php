<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\Queue;

use Dminustin\SystemNotifications\BaseClasses\BaseNotificationPayload;
use Dminustin\SystemNotifications\BaseClasses\BaseQueue;
use Dminustin\SystemNotifications\Enums\NotificationLevelEnum;
use Illuminate\Support\Facades\Redis;

class RedisQueue extends BaseQueue
{
    protected Redis $connection;
    public function __construct(Redis $connection = null)
    {
        if (!$connection) {
            $this->connection = Redis::connection('redis')->client();
        } else {
            $this->connection = $connection;
        }
    }
    public function put($queue, BaseNotificationPayload $payload): bool
    {
        return (bool) $this->connection->rPush($queue, (string) $payload);
    }

    public function get($queue): ?BaseNotificationPayload
    {
        $result = $this->connection->lPop($queue);
        $decoded = $result ? json_decode($result) : null;

        if (empty($decoded)) {
            return null;
        }

        return new BaseNotificationPayload(
            NotificationLevelEnum::from($decoded->level),
            $decoded->message,
            $decoded->context
        );
    }
}
