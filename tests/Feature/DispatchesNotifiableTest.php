<?php

namespace Asantibanez\LaravelSubscribableNotifications\Tests\Feature;

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

        $type = SalesOrderApprovedNotification::type();

        NotificationSubscription::factory()
            ->forUser($user)
            ->forType($type)
            ->create();

        $this->assertEquals(1, $user->notificationSubscriptions()->forType($type)->count());

        //Act
        SalesOrderApprovedNotification::dispatch();

        //Assert
        Notification::assertTimesSent(1, SalesOrderApprovedNotification::class);
    }

    /** @test */
    public function should_not_dispatch_notifiable_for_not_subscribed_user()
    {
        //Arrange
        /** @var User $user */
        $user = User::factory()->create();

        $type = SalesOrderApprovedNotification::type();

        $this->assertEquals(0, $user->notificationSubscriptions()->forType($type)->count());

        //Act
        SalesOrderApprovedNotification::dispatch();

        //Assert
        Notification::assertNothingSent();
    }
}
