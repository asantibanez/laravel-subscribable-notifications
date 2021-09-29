<?php


namespace Asantibanez\LaravelSubscribableNotifications\Database\Factories;

use Asantibanez\LaravelSubscribableNotifications\Models\NotificationSubscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationSubscriptionFactory extends Factory
{
    protected $model = NotificationSubscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
        ];
    }

    public function forUser($user)
    {
        return $this->state([
            'user_id' => $user->id,
        ]);
    }

    public function forType($type)
    {
        return $this->state([
            'type' => $type,
        ]);
    }
}