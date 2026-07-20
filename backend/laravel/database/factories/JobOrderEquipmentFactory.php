<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\JobOrder;
use App\Models\JobOrderEquipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobOrderEquipmentFactory extends Factory
{
    protected $model = JobOrderEquipment::class;

    public function definition(): array
    {
        return [
            'job_order_id' => JobOrder::inRandomOrder()->value('id') ?? JobOrder::factory()->create()->id,
            'equipment_id' => Equipment::inRandomOrder()->value('id') ?? Equipment::factory()->create()->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'rate' => $this->faker->randomFloat(2, 50, 500),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
