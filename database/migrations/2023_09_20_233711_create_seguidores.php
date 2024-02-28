<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{
    User,
};

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('seguidores', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignIdFor(User::class, 'user1_id')->constrained('users');
            $table->foreignIdFor(User::class, 'user2_id')->constrained('users');  
            $table->boolean('aceito')->default(false);
            $table->timestamps(); //não esta funcionando sem o timestamps não sei o motivo
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguidores');
    }
};
