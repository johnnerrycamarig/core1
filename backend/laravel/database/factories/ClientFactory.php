<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ClientType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'client_type_id' => ClientType::inRandomOrder()->value('id') ?? ClientType::factory()->create()->id,
            'name' => $this->faker->name(),
            'company_name' => $this->faker->company(),
            'contact_person' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'mobile' => $this->faker->phoneNumber(),
            'tin' => $this->faker->optional()->numerify('###-###-###'),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }

    public function individual(): self
    {
        return $this->state(fn () => [
            'client_type_id' => ClientType::firstOrCreate(['code' => 'individual'], ['label' => 'Individual'])->id,
            'company_name' => null,
        ]);
    }

    public function company(): self
    {
        return $this->state(fn () => [
            'client_type_id' => ClientType::firstOrCreate(['code' => 'company'], ['label' => 'Company'])->id,
        ]);
    }
}
