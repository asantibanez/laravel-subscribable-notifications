# Laravel Subscribable Notifications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/asantibanez/laravel-subscribable-notifications.svg?style=flat-square)](https://packagist.org/packages/asantibanez/laravel-subscribable-notifications)
[![Total Downloads](https://img.shields.io/packagist/dt/asantibanez/laravel-subscribable-notifications.svg?style=flat-square)](https://packagist.org/packages/asantibanez/laravel-subscribable-notifications)
![GitHub Actions](https://github.com/asantibanez/laravel-subscribable-notifications/actions/workflows/main.yml/badge.svg)

This package allows you to subscribe your app Users to your app Notifications and dispatch them without specifying 
the recipient. The main goal of this package is allowing you to create "lists of recipients" for your Notification classes 
and dispatch notifications to your users easily. 

### Motivation




## Installation

You can install the package via composer:

```bash
composer require asantibanez/laravel-subscribable-notifications
```

Afterwards, export both the `config` and `migrations` by using the `php artisan vendor:publish` command.

Once the `laravel-subscribable-notifications.php` config file is exported, make sure you define your `User` model and
your `subscribable_notifications` (more on this below). Only the notifications you configure will be available for subscription. 


### Usage

Using Laravel notifications systems, you normally dispatch notifications using the `Notification` facade or via the `User`
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

WIP

### Subscribing/Unsubscribing Users

Under the hood, a `notification_subscriptions` table is used to track all user subscriptions to your notifications. 

Using the `NotificationSubscriptionManager` facade, you can subscribe and unsubscribe users from notification using the
`subscribe` and `unsubscribe` methods respectively. There's also a `unsubscribeFromAll` method to remove all subscription
from a user.


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