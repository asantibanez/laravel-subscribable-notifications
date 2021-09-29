<?php

namespace Asantibanez\LaravelSubscribableNotifications;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Asantibanez\LaravelSubscribableNotifications\Skeleton\SkeletonClass
 */
class LaravelSubscribableNotificationsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-subscribable-notifications';
    }
}
