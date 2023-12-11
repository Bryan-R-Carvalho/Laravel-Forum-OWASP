<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
       \App\Models\User::factory(30)->create();
        \App\Models\Comentario::factory(50)->create();
        //\App\Models\Seguidor::factory(10)->create();
        
    }
}
