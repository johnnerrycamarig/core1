<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\JobOrder;
use App\Models\JobOrderStatus;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobOrderFactory extends Factory
{
    protected $model = JobOrder::class;

    public function definition(): array
    {
        return [
            'order_number' => strtoupper($this->faker->bothify('JO-#####')),
            'client_id' => Client::inRandomOrder()->value('id') ?? Client::factory()->create()->id,
            'project_id' => Project::inRandomOrder()->value('id') ?? Project::factory()->create()->id,
            'created_by' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'scheduled_at' => $this->faker->optional()->dateTimeBetween('now', '+30 days'),
            'status_id' => JobOrderStatus::inRandomOrder()->value('id') ?? JobOrderStatus::factory()->create()->id,
            'total_amount' => $this->faker->randomFloat(2, 100, 5000),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}
