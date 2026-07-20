<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\EquipmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    protected $model = Equipment::class;

    public function definition(): array
    {
        return [
            'category_id' => EquipmentCategory::inRandomOrder()->value('id') ?? EquipmentCategory::factory()->create()->id,
            'name' => $this->faker->word() . ' Equipment',
            'sku' => strtoupper($this->faker->bothify('EQ-#####')),
            'serial_number' => $this->faker->unique()->bothify('SN-########'),
            'description' => $this->faker->sentence(),
            'status_id' => EquipmentStatus::inRandomOrder()->value('id') ?? EquipmentStatus::factory()->create()->id,
            'hourly_rate' => $this->faker->randomFloat(2, 10, 250),
            'daily_rate' => $this->faker->randomFloat(2, 50, 1000),
            'weekly_rate' => $this->faker->randomFloat(2, 200, 3000),
            'monthly_rate' => $this->faker->randomFloat(2, 500, 10000),
            'purchased_at' => $this->faker->optional()->date(),
            'warranty_expires' => $this->faker->optional()->date(),
        ];
    }
}
