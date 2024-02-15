<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{
    User,
    Comentario
};

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('conteudo');
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Comentario::class)->nullable()->constrained();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
