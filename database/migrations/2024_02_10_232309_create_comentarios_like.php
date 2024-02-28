<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{
    Comentario,
     User
};

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('comentarios_like', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Comentario::class);
            $table->foreignIdFor(User::class);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentarios_like');
    }
};
