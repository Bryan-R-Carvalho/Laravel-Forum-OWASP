<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seguidores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seguidor_id');
            $table->unsignedBigInteger('seguido_id');
            $table->foreign('seguidor_id')->references('id')->on('users');
            $table->foreign('seguido_id')->references('id')->on('users');
            $table->unique(['seguidor_id', 'seguido_id']);
            $table->boolean('aceitado')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguidores');
    }
};
