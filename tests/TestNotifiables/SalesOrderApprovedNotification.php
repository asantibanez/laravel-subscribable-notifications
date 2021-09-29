<?php


namespace Asantibanez\LaravelSubscribableNotifications\Tests\TestNotifiables;


use Asantibanez\LaravelSubscribableNotifications\Traits\DispatchesToSubscribers;
use Illuminate\Notifications\Notification;


class SalesOrderApprovedNotification extends Notification
{
    use DispatchesToSubscribers;

    public function via($notifiable)
    {
        return [];
    }

    public static function type(): string
    {
        return 'sales_order_approved';
    }
}