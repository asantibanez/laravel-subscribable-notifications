<?php

namespace Asantibanez\LaravelSubscribableNotifications\Tests;

use Asantibanez\LaravelSubscribableNotifications\LaravelSubscribableNotificationsServiceProvider;
use Asantibanez\LaravelSubscribableNotifications\Tests\database\migrations\CreateUsersTable;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestModels\User;
use CreateNotificationSubscriptionsTable;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelSubscribableNotificationsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_notification_subscriptions_table.php';

        (new CreateUsersTable())->up();
        (new CreateNotificationSubscriptionsTable())->up();

        config(['laravel-subscribable-notifications.user_model' => User::class]);
    }
}
