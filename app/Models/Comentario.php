<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';
    protected $fillable = ['conteudo','id_user','id_comentario','likes'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
    public function post(){
        return $this->belongsTo(Comentario::class, 'id');
    }
    public function resposta(){
        return $this->hasMany(Comentario::class, 'id');
    }
    
}
