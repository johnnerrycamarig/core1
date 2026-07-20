<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationFactory extends Factory
{
    protected $model = Quotation::class;

    public function definition(): array
    {
        return [
            'quotation_number' => strtoupper($this->faker->bothify('QT-#####')),
            'client_id' => Client::inRandomOrder()->value('id') ?? Client::factory()->create()->id,
            'project_id' => null,
            'total_amount' => $this->faker->randomFloat(2, 100, 15000),
            'valid_until' => $this->faker->dateTimeBetween('now', '+60 days'),
            'created_by' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}
