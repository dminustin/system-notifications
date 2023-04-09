<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\Console\Commands;

use Dminustin\SystemNotifications\BaseClasses\BaseNotificationPayload;
use Dminustin\SystemNotifications\BaseClasses\BaseNotificationTransport;
use Dminustin\SystemNotifications\BaseClasses\BaseQueue;
use Dminustin\SystemNotifications\Enums\NotificationTransportEnum;
use Dminustin\SystemNotifications\Exceptions\BaseException;
use Dminustin\SystemNotifications\Factories\QueueFactory;
use Illuminate\Console\Command;

class BroadcastNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:broadcast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications';
    protected BaseQueue $queue;

    public function __construct(QueueFactory $queueFactory)
    {
        parent::__construct();
        $this->queue = $queueFactory->getQueue();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (NotificationTransportEnum::cases() as $case) {
            $transportName = $case->value;
            while ($queue = $this->queue->get($transportName)) {
                if (!$this->send($transportName, $queue)) {
                    $this->queue->put($transportName, $queue);

                    break;
                }
            }
        }

        return Command::SUCCESS;
    }

    /**
     * @throws BaseException
     */
    protected function send($transportName, BaseNotificationPayload $data): bool
    {
        $senderClass = NotificationTransportEnum::from($transportName)->getTransportClass();
        if (empty($senderClass)) {
            throw new BaseException('Cannot create class ' . $senderClass);
        }

        /** @var BaseNotificationTransport $transport */
        $transport = new $senderClass();

        return $transport->send($data);
    }
}
