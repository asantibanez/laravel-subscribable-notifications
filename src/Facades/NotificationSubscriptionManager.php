<?php

namespace Asantibanez\LaravelSubscribableNotifications\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class NotificationSubscriptionManager
 * @package Asantibanez\LaravelSubscribableNotifications\Facades
 * @method static subscribableNotifications(): array
 * @method static subscribe($user, $subscribableNotificationClass): void
 * @method static unsubscribe($user, $subscribableNotificationClass): void
 * @method static unsubscribeFromAll($user): void
 * @method static userModel(): string
 * @method static guessUserLabel($user): string
 */
class NotificationSubscriptionManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Asantibanez\LaravelSubscribableNotifications\NotificationSubscriptionManager::class;
    }
}
