<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeguidorFactory extends Factory
{

    public function definition(): array
    {
        return [
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
            'seguidor_id' => fake()->randomDigit(),
            'seguido_id' => fake()->randomDigit(),
        ];
    }
}
