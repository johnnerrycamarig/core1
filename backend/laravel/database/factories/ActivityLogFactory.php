<?php

namespace Database\Factories;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityLogFactory extends Factory
{
    protected $model = ActivityLog::class;

    public function definition(): array
    {
        return [
            'actor_id' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'action' => $this->faker->sentence(3),
            'target_type' => null,
            'target_id' => null,
            'metadata' => ['ip' => $this->faker->ipv4()],
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
        ];
    }
}
