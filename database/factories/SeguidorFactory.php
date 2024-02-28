<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    Seguidor,
    User
};

class SeguidorFactory extends Factory
{
    protected $model = Seguidor::class;

    public function definition(): array
    {
        $user1 = User::pluck('id')->toArray();
        $user2 = User::pluck('id')->toArray();
        return [
            'user1_id' => $this->faker->randomElement($user1),
            'user2_id' => $this->faker->randomElement($user2),
            'aceito' => $this->faker->boolean(),
        ];
    }
}
