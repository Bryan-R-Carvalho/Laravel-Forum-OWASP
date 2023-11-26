<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('conteudo');
            $table->foreignId('id_user')->constrained('id')->on('users');
            $table->foreignId('id_comentario')->nullable()->constrained('id')->on('comentarios');
            $table->integer('likes')->default(0);
            $table->json('users_like')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
