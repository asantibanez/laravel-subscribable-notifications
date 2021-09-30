<?php


namespace Asantibanez\LaravelSubscribableNotifications\Tests\TestModels;

use Asantibanez\LaravelSubscribableNotifications\Contracts\NotificationSubscriber;
use Asantibanez\LaravelSubscribableNotifications\Tests\database\factories\UserFactory;
use Asantibanez\LaravelSubscribableNotifications\Traits\HasNotificationSubscriptions;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthorizableContract, AuthenticatableContract
{
    use Authorizable;
    use Authenticatable;
    use HasFactory;
    use Notifiable;
    use HasNotificationSubscriptions;

    protected $guarded = [];

    protected $table = 'users';

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}