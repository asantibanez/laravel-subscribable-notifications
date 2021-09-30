<?php

namespace Asantibanez\LaravelSubscribableNotifications\Commands;

use Asantibanez\LaravelSubscribableNotifications\Facades\NotificationSubscriptionManager;
use Illuminate\Console\Command;

class ManageSubscribableNotifications extends Command
{
    protected $signature = 'subscribable-notifications:manage';

    protected $description = 'Manages notification subscriptions for users';

    protected $availableActions = [
        'List Subscribers',
        'Add Subscriber',
        'Remove Subscriber',
    ];

    protected $subscribableNotificationClass;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->chooseSubscribableNotification();

        $this->runAction(
            $this->chooseAction()
        );
    }

    public function chooseSubscribableNotification()
    {
        $availableSubscribableNotifications = collect(NotificationSubscriptionManager::subscribableNotifications());

        if ($availableSubscribableNotifications->isEmpty()) {
            $this->warn('No subscribable notifications configured');
            return;
        }

        $subscribableNotificationType = $this->choice(
            'Which notification subscriptions would you like to manage?',
            $availableSubscribableNotifications
                ->map(fn ($subscribableNotificationClass) => $subscribableNotificationClass::subscribableNotificationType())
                ->toArray()
        );

        $this->subscribableNotificationClass = NotificationSubscriptionManager::subscribableNotificationClassFromType($subscribableNotificationType);
    }

    public function chooseAction()
    {
        return $this->choice('What would you like to do?', $this->availableActions);
    }

    public function runAction($action)
    {
        if ($action === 'List Subscribers') {
            $this->info('Subscribers:');

            $this->subscribableNotificationClass::subscribers()
                ->each(function ($user) {
                    $this->info('- ' . NotificationSubscriptionManager::guessUserLabel($user));
                });

            return;
        }

        if ($action === 'Add Subscriber') {
            $userId = $this->ask('User Id:');

            NotificationSubscriptionManager::subscribe(
                $user = NotificationSubscriptionManager::userModel()::findOrFail($userId),
                $this->subscribableNotificationClass
            );

            $userLabel = NotificationSubscriptionManager::guessUserLabel($user);

            $this->info("User '$userLabel' subscribed");

            return;
        }

        if ($action === 'Remove Subscriber') {
            $userId = $this->ask('User Id:');

            NotificationSubscriptionManager::unsubscribe(
                $user = NotificationSubscriptionManager::userModel()::findOrFail($userId),
                $this->subscribableNotificationClass
            );

            $userLabel = NotificationSubscriptionManager::guessUserLabel($user);

            $this->info("User '$userLabel' unsubscribed");

            return;
        }

        $this->warn('Action not recognized');
    }
}
