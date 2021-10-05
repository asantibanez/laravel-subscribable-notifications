<?php


namespace Asantibanez\LaravelSubscribableNotifications\Tests\TestNotifiables;


use Asantibanez\LaravelSubscribableNotifications\Contracts\SubscribableNotification;
use Asantibanez\LaravelSubscribableNotifications\Traits\DispatchesToSubscribers;
use Illuminate\Notifications\Notification;


class SalesOrderRejectedNotification extends Notification implements SubscribableNotification
{
    use DispatchesToSubscribers;

    public function via($notifiable)
    {
        return [];
    }

    public static function subscribableNotificationType(): string
    {
        return 'sales-order.rejected';
    }
}