<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'recipient_id' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'actor_id' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'verb' => $this->faker->word(),
            'target_type' => null,
            'target_id' => null,
            'data' => ['message' => $this->faker->sentence()],
            'sent_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
            'read_at' => $this->faker->optional()->dateTimeBetween('-6 days', 'now'),
        ];
    }
}
