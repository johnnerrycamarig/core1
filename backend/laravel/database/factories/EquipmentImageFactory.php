<?php

namespace Database\Factories;

use App\Models\EquipmentImage;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentImageFactory extends Factory
{
    protected $model = EquipmentImage::class;

    public function definition(): array
    {
        return [
            'equipment_id' => Equipment::inRandomOrder()->value('id') ?? Equipment::factory()->create()->id,
            'filename' => $this->faker->word() . '.jpg',
            'path' => 'equipment/' . $this->faker->uuid() . '.jpg',
            'mime_type' => 'image/jpeg',
            'size' => $this->faker->numberBetween(10000, 2000000),
            'is_primary' => $this->faker->boolean(30),
        ];
    }
}
