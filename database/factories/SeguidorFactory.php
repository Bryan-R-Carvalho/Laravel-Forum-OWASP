<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeguidorFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user1_id' => $this->faker->numberBetween(1, 100),
            'user2_id' => $this->faker->numberBetween(1, 100),
            'aceito' => $this->faker->boolean(),
        ];
    }
}
