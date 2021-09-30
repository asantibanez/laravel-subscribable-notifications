<?php

namespace Asantibanez\LaravelSubscribableNotifications\Traits;

use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasNotificationSubscriptions
{
    public function notificationSubscriptions(): HasMany
    {
        return $this->hasMany(NotificationSubscription::class, 'user_id');
    }
}