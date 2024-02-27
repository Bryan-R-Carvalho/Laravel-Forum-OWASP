<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Comentario,
    Seguidor
};

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
      User::factory(100)->create();
      Comentario::factory(100)->create();
      Seguidor::factory(100)->create();
        
    }
}