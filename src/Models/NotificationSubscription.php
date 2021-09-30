<?php

namespace Asantibanez\LaravelSubscribableNotifications\Models;

use Asantibanez\LaravelSubscribableNotifications\Database\Factories\NotificationSubscriptionFactory;
use Asantibanez\LaravelSubscribableNotifications\Facades\NotificationSubscriptionManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user
 */
class NotificationSubscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(NotificationSubscriptionManager::userModel());
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
