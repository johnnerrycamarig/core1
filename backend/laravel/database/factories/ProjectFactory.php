<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::inRandomOrder()->value('id') ?? Client::factory()->create()->id,
            'name' => $this->faker->company . ' Project',
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->optional()->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'status_id' => ProjectStatus::inRandomOrder()->value('id') ?? ProjectStatus::factory()->create()->id,
            'budget' => $this->faker->optional()->randomFloat(2, 1000, 50000),
            'created_by' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
        ];
    }
}
