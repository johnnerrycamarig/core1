<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition(): array
    {
        return [
            'attachable_type' => Client::class,
            'attachable_id' => Client::inRandomOrder()->value('id') ?? Client::factory()->create()->id,
            'filename' => $this->faker->word() . '.pdf',
            'path' => 'attachments/' . $this->faker->uuid() . '.pdf',
            'mime_type' => 'application/pdf',
            'size' => $this->faker->numberBetween(10000, 5000000),
            'uploaded_by' => null,
        ];
    }
}
