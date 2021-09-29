<?php

namespace Asantibanez\LaravelSubscribableNotifications;

use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;

class NotificationSubscriptionManager
{
    public function subscribableNotifications()
    {
        return config('laravel-subscribable-notifications.subscribable_notifications');
    }

    public function subscribe($user, $notification)
    {
        NotificationSubscription::updateOrCreate([
            'type' => $notification::type(),
            'user_id' => $user->id,
        ], [
            //
        ]);
    }

    public function unsubscribe($user, $notification)
    {
        NotificationSubscription::query()
            ->where([
                'type' => $notification::type(),
                'user_id' => $user->id,
            ])
            ->delete();
    }

    public function unsubscribeAll($user)
    {
        NotificationSubscription::query()
            ->where([
                'user_id' => $user->id,
            ])
            ->delete();
    }
}
