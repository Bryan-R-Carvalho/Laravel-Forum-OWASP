<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioFactory extends Factory
{

    public function definition(): array
    {
        return [
            'conteudo' => fake()->realText(),
            'id_user' => \App\Models\User::factory(),
            'id_comentario' => \App\Models\Comentario::factory(),
            'users_like' => null
        ];
    }
}
