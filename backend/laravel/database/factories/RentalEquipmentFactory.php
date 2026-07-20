<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Rental;
use App\Models\RentalEquipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalEquipmentFactory extends Factory
{
    protected $model = RentalEquipment::class;

    public function definition(): array
    {
        return [
            'rental_id' => Rental::inRandomOrder()->value('id') ?? Rental::factory()->create()->id,
            'equipment_id' => Equipment::inRandomOrder()->value('id') ?? Equipment::factory()->create()->id,
            'quantity' => $this->faker->numberBetween(1, 10),
            'rate' => $this->faker->randomFloat(2, 20, 1000),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
