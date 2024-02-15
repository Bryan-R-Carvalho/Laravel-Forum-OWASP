<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{
    use HasFactory;
    protected $table = 'seguidores';
    protected $fillable = ['seguidor_id', 'seguido_id', 'aceitado'];

    public function seguidores()
    {
        return $this->hasMany(User::class, 'seguidor_id');
    }
    public function seguidos()
    {
        return $this->hasMany(User::class, 'seguido_id');
    }

}
