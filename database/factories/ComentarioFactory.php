<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{

    public function definition(): array
    {
        return [
            'conteudo' => fake()->realText(),
            'id_user' => \App\Models\User::factory(),
        ];
    }
}
