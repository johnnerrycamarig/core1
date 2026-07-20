<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomElement(['cash', 'card', 'bank_transfer', 'cheque']),
            'label' => ucfirst(str_replace('_', ' ', $this->faker->word())),
        ];
    }
}
