<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    User,
    Comentario
    };

class ComentarioFactory extends Factory
{
    protected $model = Comentario::class;

    public function definition(): array
    {
        $usuarios = User::pluck('id')->toArray();
        $comentarios = Comentario::pluck('id')->toArray();
        return [
            'conteudo' => $this->faker->realText(),
            'user_id' => $this->faker->randomElement($usuarios),
            'comentario_id' => $this->faker->randomElement($comentarios), 
            'ativo' => true,
        ];
    }
}
