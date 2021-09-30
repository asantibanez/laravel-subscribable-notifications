<?php

namespace Asantibanez\LaravelSubscribableNotifications;

use Asantibanez\LaravelSubscribableNotifications\Contracts\SubscribableNotification;
use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;

class NotificationSubscriptionManager
{
    public function subscribableNotificationClassFromType($type): ?string
    {
        return collect($this->subscribableNotifications())
            ->first(function ($class) use ($type) {
                return $class::subscribableNotificationType() === $type;
            });
    }

    public function subscribableNotifications(): array
    {
        return collect(config('laravel-subscribable-notifications.subscribable_notifications'))
            ->filter(function ($class) {
                return in_array(SubscribableNotification::class, class_implements($class));
            })
            ->toArray();
    }

    public function subscribe($user, $subscribableNotificationClass)
    {
        NotificationSubscription::updateOrCreate([
            'type' => $subscribableNotificationClass::subscribableNotificationType(),
            'user_id' => $user->id,
        ], [
            //
        ]);
    }

    public function unsubscribe($user, $subscribableNotificationClass)
    {
        NotificationSubscription::query()
            ->where([
                'type' => $subscribableNotificationClass::subscribableNotificationType(),
                'user_id' => $user->id,
            ])
            ->delete();
    }

    public function unsubscribeFromAll($user)
    {
        NotificationSubscription::query()
            ->where([
                'user_id' => $user->id,
            ])
            ->delete();
    }

    public function userModel()
    {
        return config('laravel-subscribable-notifications.user_model');
    }

    public function guessUserLabel($user)
    {
        return collect()
            ->push(data_get($user, 'email'))
            ->push(data_get($user, 'name'))
            ->push(data_get($user, 'last_name'))
            ->push(data_get($user, 'first_name'))
            ->push(data_get($user, 'id'))
            ->filter()
            ->first()
        ;
    }
}
