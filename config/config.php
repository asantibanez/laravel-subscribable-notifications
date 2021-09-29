<?php

use Asantibanez\LaravelSubscribableNotifications\Tests\TestModels\User;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestNotifiables\SalesOrderApprovedNotification;

return [
    'user_model' => User::class,

    'subscribable_notifications' => [
        SalesOrderApprovedNotification::class,
    ],
];