<?php

namespace Asantibanez\LaravelSubscribableNotifications\Facades;

use Illuminate\Support\Facades\Facade;

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
