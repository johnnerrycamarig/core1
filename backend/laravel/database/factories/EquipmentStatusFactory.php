<?php

namespace Database\Factories;

use App\Models\EquipmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentStatusFactory extends Factory
{
    protected $model = EquipmentStatus::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomElement(['available', 'maintenance', 'retired', 'in_service']),
            'label' => $this->faker->word(),
        ];
    }
}
