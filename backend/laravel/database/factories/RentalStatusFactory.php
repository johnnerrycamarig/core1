<?php

namespace Database\Factories;

use App\Models\RentalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalStatusFactory extends Factory
{
    protected $model = RentalStatus::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomElement(['reserved', 'active', 'completed', 'overdue', 'cancelled']),
            'label' => ucfirst(str_replace('_', ' ', $this->faker->word())),
        ];
    }
}
