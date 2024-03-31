<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Comentarios;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ComentariosTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Comentarios::class)
            ->assertStatus(200);
    }
}
