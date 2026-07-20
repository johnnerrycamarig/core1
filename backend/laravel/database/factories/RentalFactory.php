<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Rental;
use App\Models\RentalStatus;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalFactory extends Factory
{
    protected $model = Rental::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', '+1 week');
        $end = $this->faker->dateTimeBetween($start, '+1 month');

        return [
            'rental_number' => strtoupper($this->faker->bothify('RE-#####')),
            'client_id' => Client::inRandomOrder()->value('id') ?? Client::factory()->create()->id,
            'project_id' => Project::inRandomOrder()->value('id') ?? Project::factory()->create()->id,
            'created_by' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'status_id' => RentalStatus::inRandomOrder()->value('id') ?? RentalStatus::factory()->create()->id,
            'total_amount' => $this->faker->randomFloat(2, 200, 10000),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}
