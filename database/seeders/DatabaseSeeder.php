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
      User::factory(10)->create();
      Comentario::factory(10)->create();
      //Seguidor::factory(10)->create();
        
    }
}