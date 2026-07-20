<?php

namespace Database\Factories;

use App\Models\JobOrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobOrderStatusFactory extends Factory
{
    protected $model = JobOrderStatus::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomElement(['draft', 'open', 'in_progress', 'completed', 'cancelled']),
            'label' => ucfirst(str_replace('_', ' ', $this->faker->word())),
        ];
    }
}
