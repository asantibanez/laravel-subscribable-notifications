# Laravel Subscribable Notifications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/asantibanez/laravel-subscribable-notifications.svg?style=flat-square)](https://packagist.org/packages/asantibanez/laravel-subscribable-notifications)
[![Total Downloads](https://img.shields.io/packagist/dt/asantibanez/laravel-subscribable-notifications.svg?style=flat-square)](https://packagist.org/packages/asantibanez/laravel-subscribable-notifications)
![GitHub Actions](https://github.com/asantibanez/laravel-subscribable-notifications/actions/workflows/main.yml/badge.svg)

This package allows you to subscribe your app Users to your app Notifications and dispatch them without specifying 
the recipient. The main goal of this package is allowing you to create "lists of recipients" for your Notification classes 
and dispatch notifications to your users easily. 

### Motivation

Recently I've been developing back-office kind of apps where a group of users need to be notified via email for a particular 
event or scenario in the system. These users were being hardcoded in the app and sometimes they needed to subscribe or be 
removed from certain emails, depending on the job they were doing at the company. Since their emails were hardcoded, it was
tricky to update the "subscribers" list to each mailable that was sent by the application. With that idea in mind, this
package was created to allow configuring users to each mailable they need to receive.

### Installation

You can install the package via composer:

```bash
composer require asantibanez/laravel-subscribable-notifications
```

Afterwards, export both the `config` and `migrations` by using the `php artisan vendor:publish` command.

Once the `laravel-subscribable-notifications.php` config file is exported, make sure you define your `User` model and
your `subscribable_notifications` (more on this below). Only the notifications you configure will be available for subscription. 

### Usage

Using Laravel notifications system, you normally dispatch notifications using the `Notification` facade or via the `User`
model `notify()` method when implementing the `Notifiable` trait.

```php
Notification::send([$user1, $user2, $user3], new OrderShipped($order));

// or 
$notification = new OrderShipped($order);

$user1->notify($notification);
$user2->notify($notification);
$user3->notify($notification);
```

With `laravel-subscribable-notifications`, you send the notification by "dispatching" it. Any subscribed user to the 
notification will receive it.

```php
OrderShipped::dispatch($order);
```

### Preparing your Notifications

Notifications must implement the `SubscribableNotification` interface which will require to implement the following methods:
- dispatch
- subscribers
- subscribableNotificationType

For these, add the `DispatchesToSubscriber` trait to your notification which will cover `dispatch` and `subscribers`. Lastly,
implement `subscribableNotificationType` by providing a string that identifies your notification. This value will be saved
in the database for your users subscriptions.

```php
class SalesOrderApprovedNotification extends Notification implements SubscribableNotification
{
    use DispatchesToSubscribers;

    public static function subscribableNotificationType(): string
    {
        return 'sales-order.approved';
    }
    
    // notification implementation here
}
```

You must also add your notification to the `subscribable_notifications` array inside `laravel-subscribable-notifications` config.
Registering your notification here will allow the package to know which notifications can be dispatched throughout this 
interface.

### Subscribing/Unsubscribing Users

Under the hood, a `notification_subscriptions` table is used to track all user subscriptions to your notifications. 

Using the `NotificationSubscriptionManager` facade, you can subscribe and unsubscribe users from notification using the
`subscribe` and `unsubscribe` methods respectively. There's also a `unsubscribeFromAll` method to remove all subscription
from a user.

>Note: Your `User` model can implement the `HasNotificationSubscriptions` trait to get helper methods in order to know
> what subscriptions each user has been subscribed to.

### Utilities

The package register a new `subscribable-notifications:manage` command which you can run in your terminal and interact
with the `notification_subscriptions` table. The command allows you to list/add/remove users from notifications you've
defined in the `laravel-subscribable-notifications` config file.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email santibanez.andres@gmail.com instead of using the issue tracker.

## Credits

-   [Andrés Santibáñez](https://github.com/asantibanez)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.