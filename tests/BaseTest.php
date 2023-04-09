<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\Tests;

use Dminustin\SystemNotifications\Enums\NotificationLevelEnum;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public function testEnums(): void
    {
        $level = NotificationLevelEnum::LOG_LEVEL_INFO;
        $this->assertEquals(NotificationLevelEnum::LOG_LEVEL_INFO, $level);
        $newLevel = NotificationLevelEnum::from('info');
        $this->assertEquals($level, $newLevel);
    }
}
