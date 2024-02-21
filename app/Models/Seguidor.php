<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{
    use HasFactory;
    protected $table = 'seguidores';
    protected $fillable = ['user1_id', 'user2_id', 'aceito'];

    public function seguidores()
    {
        return $this->hasMany(User::class, 'user1_id');
    }
    public function seguidos()
    {
        return $this->hasMany(User::class, 'user2_id');
    }

}
