<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\BaseClasses;

use Dminustin\SystemNotifications\Enums\NotificationLevelEnum;
use Dminustin\SystemNotifications\Enums\NotificationTransportEnum;

class BaseNotificationRequest extends BaseDTO
{
    public array $transport = [];
    public string $level;
    public string $message;
    public array $context = [];

    /**
     * @param NotificationTransportEnum[] $transport
     * @param NotificationLevelEnum $level
     * @param string $message
     * @param array $context
     */
    public function __construct(
        array $transport,
        NotificationLevelEnum $level,
        string $message,
        array $context = []
    ) {
        foreach ($transport as $value) {
            $this->transport[] = $value->value;
        }
        $this->level = $level->value;
        $this->message = $message;
        $this->context = $context;
    }
}
