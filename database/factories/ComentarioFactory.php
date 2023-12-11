<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioFactory extends Factory
{

    public function definition(): array
    {

        return [
            'conteudo' => $this->faker->realText(120),
            'id_user' => $this->faker->numberBetween(1, 30),
            'id_comentario' => null,
            'likes' => 0,
            'users_like' => null,
            'ativo' => true,
        ];

    }
}
