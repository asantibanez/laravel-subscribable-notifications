<?php

namespace Asantibanez\LaravelSubscribableNotifications\Tests\Unit;

use Asantibanez\LaravelSubscribableNotifications\Facades\NotificationSubscriptionManager;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestCase;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestModels\User;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestNotifiables\SalesOrderApprovedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class NotificationSubscriptionManagerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function should_subscribe_user_to_notification()
    {
        //Arrange
        /** @var User $user */
        $user = User::factory()->create();

        $this->assertEquals(0, $user->notificationSubscriptions()->count());

        //Act
        NotificationSubscriptionManager::subscribe($user, SalesOrderApprovedNotification::class);

        //Assert
        $this->assertEquals(1, $user->notificationSubscriptions()->count());
    }

    /** @test */
    public function should_unsubscribe_user_to_notification()
    {
        //Arrange
        /** @var User $user */
        $user = User::factory()->create();

        NotificationSubscriptionManager::subscribe($user, SalesOrderApprovedNotification::class);

        $this->assertEquals(1, $user->notificationSubscriptions()->count());

        //Act
        NotificationSubscriptionManager::unsubscribe($user, SalesOrderApprovedNotification::class);

        //Assert
        $this->assertEquals(0, $user->notificationSubscriptions()->count());
    }

    /** @test */
    public function should_get_list_of_subscribable_notifications()
    {
        //Arrange
        $notifications = [
            $this->faker->word,
            $this->faker->word,
            $this->faker->word,
        ];

        config(['laravel-subscribable-notifications.subscribable_notifications' => $notifications]);

        //Act
        $result = NotificationSubscriptionManager::subscribableNotifications();

        //Assert
        $this->assertEquals($notifications, $result);
    }
}
