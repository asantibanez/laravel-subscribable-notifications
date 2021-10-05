<?php


namespace Asantibanez\LaravelSubscribableNotifications\Traits;


use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;
use Illuminate\Support\Facades\Notification;

trait DispatchesToSubscribers
{
    public static function dispatch()
    {
        Notification::send(
            static::subscribers(),
            new static(...func_get_args())
        );
    }

    public static function subscribers()
    {
        return NotificationSubscription::query()
            ->forType(static::subscribableNotificationType())
            ->get()
            ->map(fn (NotificationSubscription $notificationSubscription) => (
                $notificationSubscription->user
            ))
            ->unique();
    }
}