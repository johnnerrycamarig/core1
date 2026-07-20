<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectTaskFactory extends Factory
{
    protected $model = ProjectTask::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::inRandomOrder()->value('id') ?? Project::factory()->create()->id,
            'parent_task_id' => null,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'assigned_to' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'status_id' => TaskStatus::inRandomOrder()->value('id') ?? TaskStatus::factory()->create()->id,
            'priority' => $this->faker->numberBetween(1, 5),
            'due_date' => $this->faker->optional()->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'started_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'completed_at' => null,
            'created_by' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
        ];
    }
}
