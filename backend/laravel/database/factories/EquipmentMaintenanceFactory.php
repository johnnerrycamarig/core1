<?php

namespace Database\Factories;

use App\Models\EquipmentMaintenance;
use App\Models\Equipment;
use App\Models\MaintenanceType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentMaintenanceFactory extends Factory
{
    protected $model = EquipmentMaintenance::class;

    public function definition(): array
    {
        return [
            'equipment_id' => Equipment::inRandomOrder()->value('id') ?? Equipment::factory()->create()->id,
            'maintenance_type_id' => MaintenanceType::inRandomOrder()->value('id') ?? MaintenanceType::factory()->create()->id,
            'performed_by' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'scheduled_at' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'performed_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'notes' => $this->faker->optional()->sentence(),
            'cost' => $this->faker->randomFloat(2, 50, 500),
            'next_due_at' => $this->faker->optional()->dateTimeBetween('now', '+3 months'),
            'created_by' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
        ];
    }
}
