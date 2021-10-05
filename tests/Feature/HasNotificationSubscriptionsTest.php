<?php

namespace Asantibanez\LaravelSubscribableNotifications\Tests\Feature;

use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestCase;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestModels\User;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestNotifiables\SalesOrderApprovedNotification;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestNotifiables\SalesOrderRejectedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class HasNotificationSubscriptionsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function should_get_subscribed_notifications()
    {
        //Arrange
        /** @var User $user */
        $user = User::factory()->create();

        NotificationSubscription::factory()
            ->forUser($user)
            ->forType(SalesOrderApprovedNotification::subscribableNotificationType())
            ->create();

        //Act
        $result = $user->refresh()->notificationSubscriptions;

        //Assert
        $this->assertEquals(1, $result->count());

        $this->assertEquals(
            $result->first()->type,
            SalesOrderApprovedNotification::subscribableNotificationType()
        );
    }

    /** @test */
    public function should_check_if_subscribed_to_notification()
    {
        //Arrange
        /** @var User $user */
        $user = User::factory()->create();

        NotificationSubscription::factory()
            ->forUser($user)
            ->forType(SalesOrderApprovedNotification::subscribableNotificationType())
            ->create();

        //Act - Assert
        $this->assertTrue($user->isSubscribedToNotification(SalesOrderApprovedNotification::subscribableNotificationType()));
        $this->assertFalse($user->isSubscribedToNotification(SalesOrderRejectedNotification::subscribableNotificationType()));
    }
}
