<?php

namespace Asantibanez\LaravelSubscribableNotifications\Models;

use Asantibanez\LaravelSubscribableNotifications\Database\Factories\NotificationSubscriptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user
 */
class NotificationSubscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'channels' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(config('laravel-subscribable-notifications.user_model'));
    }

    public function scopeForType($query, $type)
    {
        $query->where('type', $type);
    }

    protected static function newFactory()
    {
        return NotificationSubscriptionFactory::new();
    }
}
