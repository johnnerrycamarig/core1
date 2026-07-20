<?php

namespace Database\Factories;

use App\Models\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceStatusFactory extends Factory
{
    protected $model = InvoiceStatus::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomElement(['draft', 'issued', 'paid', 'overdue', 'cancelled']),
            'label' => ucfirst(str_replace('_', ' ', $this->faker->word())),
        ];
    }
}
