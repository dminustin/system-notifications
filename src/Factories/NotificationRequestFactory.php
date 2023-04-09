<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\Factories;

use Dminustin\SystemNotifications\BaseClasses\BaseNotificationPayload;
use Dminustin\SystemNotifications\BaseClasses\BaseNotificationRequest;
use Dminustin\SystemNotifications\BaseClasses\BaseQueue;
use Dminustin\SystemNotifications\Enums\NotificationLevelEnum;

class NotificationRequestFactory
{
    protected string $appName;
    protected BaseQueue $queue;

    public function __construct(QueueFactory $factory)
    {
        $this->appName = env('APP_NAME');
        $this->queue = $factory->getQueue();
    }

    /**
     * @param BaseNotificationRequest $data
     */
    public function putRequests(BaseNotificationRequest $data): bool
    {
        $payloads = [];
        foreach ($data->transport as $transport) {
            $payloads[$transport] = new BaseNotificationPayload(
                NotificationLevelEnum::from($data->level),
                $data->message,
                $data->context,
            );
        }
        $return = true;
        foreach ($payloads as $transport => $payload) {
            $return = $return && $this->queue->put($transport, $payload);
        }

        return $return;
    }
}
