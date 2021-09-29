<?php

namespace Asantibanez\LaravelSubscribableNotifications\Traits;

use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;

trait HasNotificationSubscriptions
{
    public function notificationSubscriptions()
    {
        return $this->hasMany(NotificationSubscription::class, 'user_id');
    }
}