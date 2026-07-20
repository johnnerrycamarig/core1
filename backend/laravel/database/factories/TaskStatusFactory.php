<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskStatusFactory extends Factory
{
    protected $model = TaskStatus::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomElement(['todo', 'in_progress', 'review', 'done', 'blocked']),
            'label' => ucfirst(str_replace('_', ' ', $this->faker->word())),
        ];
    }
}
