<?php

namespace Asantibanez\LaravelSubscribableNotifications\Providers;

use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        NotificationSending::class => [
            //
        ],
    ];
}