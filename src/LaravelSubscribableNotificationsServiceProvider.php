<?php

namespace Asantibanez\LaravelSubscribableNotifications;

use Asantibanez\LaravelSubscribableNotifications\Providers\EventServiceProvider;
use Illuminate\Support\ServiceProvider;

class LaravelSubscribableNotificationsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-subscribable-notifications');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-subscribable-notifications');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-subscribable-notifications.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-subscribable-notifications'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-subscribable-notifications'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-subscribable-notifications'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-subscribable-notifications');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-subscribable-notifications', function () {
            return new LaravelSubscribableNotifications;
        });

        $this->app->register(EventServiceProvider::class);
    }
}
