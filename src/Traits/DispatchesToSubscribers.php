<?php


namespace Asantibanez\LaravelSubscribableNotifications\Traits;


use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;
use Illuminate\Support\Facades\Notification;

trait DispatchesToSubscribers
{
    public abstract static function type(): string;

    public static function dispatch()
    {
        $users = NotificationSubscription::query()
            ->forType(static::type())
            ->get()
            ->map(fn (NotificationSubscription $notificationSubscription) => $notificationSubscription->user);

        Notification::send($users, new static(...func_get_args()));
    }
}