<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'invoice_number' => strtoupper($this->faker->bothify('IN-#####')),
            'client_id' => Client::inRandomOrder()->value('id') ?? Client::factory()->create()->id,
            'invoiceable_type' => null,
            'invoiceable_id' => null,
            'amount_due' => $this->faker->randomFloat(2, 100, 10000),
            'amount_paid' => 0,
            'due_date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'issued_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'status_id' => InvoiceStatus::inRandomOrder()->value('id') ?? InvoiceStatus::factory()->create()->id,
            'created_by' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}
