<?php


namespace Asantibanez\LaravelSubscribableNotifications\Tests\TestNotifiables;


use Asantibanez\LaravelSubscribableNotifications\Contracts\SubscribableNotification;
use Asantibanez\LaravelSubscribableNotifications\Traits\DispatchesToSubscribers;
use Illuminate\Notifications\Notification;


class SalesOrderApprovedNotification extends Notification implements SubscribableNotification
{
    use DispatchesToSubscribers;

    public $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function via($notifiable)
    {
        return [];
    }

    public static function subscribableNotificationType(): string
    {
        return 'sales-order.approved';
    }
}