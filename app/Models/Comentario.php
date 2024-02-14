<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';
    protected $fillable = [
        'conteudo',
        'user_id',
        'comentario_id',
        'ativo'
    ];

    protected $casts = [
        'users_like' => 'array'
    ];
    
    public function autor(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resposta(){
        return $this->hasMany(Comentario::class, 'id');
    }
    
    public function likes(){
        return $this->belongsToMany(User::class, 'comentarios_like');
    }
}
