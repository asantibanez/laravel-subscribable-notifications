<?php

namespace Asantibanez\LaravelSubscribableNotifications;

use Asantibanez\LaravelSubscribableNotifications\Providers\EventServiceProvider;
use Illuminate\Support\ServiceProvider;

class LaravelSubscribableNotificationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-subscribable-notifications.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../database/migrations/create_notification_subscriptions_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_notification_subscriptions_table.php'),
            ], 'migrations');
        }
    }

    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-subscribable-notifications');

        $this->app->register(EventServiceProvider::class);
    }
}
