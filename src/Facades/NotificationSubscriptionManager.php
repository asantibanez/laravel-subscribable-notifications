<?php

namespace Asantibanez\LaravelSubscribableNotifications\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class NotificationSubscriptionManager
 * @package Asantibanez\LaravelSubscribableNotifications\Facades
 * @method static array subscribableNotifications()
 * @method static void subscribe($user, $subscribableNotificationClass)
 * @method static void unsubscribe($user, $subscribableNotificationClass)
 * @method static void unsubscribeFromAll($user)
 * @method static string userModel()
 * @method static string guessUserLabel($user)
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
