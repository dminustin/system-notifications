<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\Queue;

use Dminustin\SystemNotifications\BaseClasses\BaseNotificationPayload;
use Dminustin\SystemNotifications\BaseClasses\BaseQueue;
use Dminustin\SystemNotifications\Enums\NotificationLevelEnum;
use Illuminate\Support\Facades\Redis;

class RedisQueue extends BaseQueue
{
    public function put($queue, BaseNotificationPayload $payload): bool
    {
        return (bool) Redis::connection('redis')->client()->rPush($queue, (string) $payload);
    }

    public function get($queue): ?BaseNotificationPayload
    {
        $result = Redis::connection('redis')->client()->lPop($queue);
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
