<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\BaseClasses;

use Dminustin\SystemNotifications\Enums\NotificationLevelEnum;

class BaseNotificationPayload extends BaseDTO
{
    public string $level;
    public string $message;
    public array $context = [];

    /**
     * @param NotificationLevelEnum $level
     * @param string $message
     * @param array $context
     */
    public function __construct(
        NotificationLevelEnum $level,
        string $message,
        array $context = []
    ) {
        $this->level = $level->value;
        $this->message = $message;
        $this->context = $context;
    }
}
