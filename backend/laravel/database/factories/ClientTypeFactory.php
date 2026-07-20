<?php

namespace Database\Factories;

use App\Models\ClientType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientTypeFactory extends Factory
{
    protected $model = ClientType::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomElement(['individual', 'company']),
            'label' => ucfirst($this->faker->word()),
        ];
    }
}
