<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\Queue;

use Dminustin\SystemNotifications\BaseClasses\BaseNotificationPayload;
use Dminustin\SystemNotifications\BaseClasses\BaseQueue;
use Dminustin\SystemNotifications\Enums\NotificationLevelEnum;
use Illuminate\Support\Facades\Redis as RedisFacade;

class RedisQueue extends BaseQueue
{
    protected \Redis $connection;
    protected string $prefix;

    public function __construct(\Redis $connection = null, string $prefix = '')
    {
        if (!$connection) {
            $this->connection = RedisFacade::connection('redis')->client();
        } else {
            $this->connection = $connection;
        }
        $this->prefix = $prefix;
    }
    public function put($queue, BaseNotificationPayload $payload): bool
    {
        return (bool) $this->connection->rPush($this->prefix . '_' . $queue, (string) $payload);
    }

    public function get($queue): ?BaseNotificationPayload
    {
        $result = $this->connection->lPop($this->prefix . '_' . $queue);
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
