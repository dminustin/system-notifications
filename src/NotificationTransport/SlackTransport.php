<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\NotificationTransport;

use Dminustin\SystemNotifications\BaseClasses\BaseNotificationPayload;
use Dminustin\SystemNotifications\BaseClasses\BaseNotificationTransport;
use Dminustin\SystemNotifications\Enums\NotificationLevelEnum;

class SlackTransport extends BaseNotificationTransport
{
    public function send(BaseNotificationPayload $notification): bool
    {
        $icon = match ($notification->level) {
            NotificationLevelEnum::LOG_LEVEL_INFO->value => 'cool',
            NotificationLevelEnum::LOG_LEVEL_SUCCESS->value => 'accept',
            default => 'sos',
        };

        $message = ['payload' => json_encode([
            'channel' => '#website-updates',
            'username' => 'webhookbot',
            'text' => '[' . env('APP_NAME') . '] ' . $notification->message . ' updated',
            'icon_emoji' => ':' . $icon . ':'
        ])];

        // Use curl to send your message
        $c = curl_init(env('SLACK_WEBHOOK_URL'));
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);//NOSONAR
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $message);
        $result = curl_exec($c);
        curl_close($c);

        return $result;
    }
}
