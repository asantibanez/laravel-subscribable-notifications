<?php

namespace Asantibanez\LaravelSubscribableNotifications\Traits;

use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait HasNotificationSubscriptions
 * @package Asantibanez\LaravelSubscribableNotifications\Traits
 * @property-read Collection|NotificationSubscription[] $notificationSubscriptions
 */
trait HasNotificationSubscriptions
{
    public function notificationSubscriptions(): HasMany
    {
        return $this->hasMany(NotificationSubscription::class, 'user_id');
    }

    public function isSubscribedToNotification($type): bool
    {
        return $this->notificationSubscriptions()
            ->forType($type)
            ->exists();
    }
}