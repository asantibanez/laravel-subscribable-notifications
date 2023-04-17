<?php

namespace Asantibanez\LaravelSubscribableNotifications\Tests\Feature;

use Asantibanez\LaravelSubscribableNotifications\Facades\NotificationSubscriptionManager;
use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestCase;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestModels\User;
use Asantibanez\LaravelSubscribableNotifications\Tests\TestNotifiables\SalesOrderApprovedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;

class DispatchesNotifiableTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();
    }

    /** @test */
    public function should_dispatch_notifiable_for_subscribed_user()
    {
        //Arrange
        /** @var User $user */
        $user = User::factory()->create();
        // Notification::fake();

        $type = SalesOrderApprovedNotification::subscribableNotificationType();

        NotificationSubscription::factory()
            ->forUser($user)
            ->forType($type)
            ->create();

        $this->assertEquals(1, $user->notificationSubscriptions()->forType($type)->count());

        //Act
        SalesOrderApprovedNotification::dispatch($payload = [1, 2, 3]);

        //Assert
        Notification::assertSent(SalesOrderApprovedNotification::class, 1);

        Notification::assertSentTo($user, SalesOrderApprovedNotification::class, function ($notification) use ($payload) {
            $this->assertEquals($payload, $notification->payload);
            return true;
        });
    }

    /** @test */
    public function should_not_dispatch_notifiable_for_not_subscribed_user()
    {
        //Arrange
        /** @var User $user */
        $user = User::factory()->create();

        $type = SalesOrderApprovedNotification::subscribableNotificationType();

        $this->assertEquals(0, $user->notificationSubscriptions()->forType($type)->count());

        //Act
        SalesOrderApprovedNotification::dispatch([]);

        //Assert
        Notification::assertNothingSent();
    }

    /** @test */
    public function should_not_dispatch_notifiable_for_not_found_users()
    {
        //Arrange
        /** @var User $user */
        $user = User::factory()->create();

        $deletedUser = User::factory()->create();

        NotificationSubscriptionManager::subscribe($user, SalesOrderApprovedNotification::class);
        NotificationSubscriptionManager::subscribe($deletedUser, SalesOrderApprovedNotification::class);

        $deletedUser->delete();

        //Act
        SalesOrderApprovedNotification::dispatch();

        //Assert
        Notification::assertSent(SalesOrderApprovedNotification::class, 1);
    }
}
