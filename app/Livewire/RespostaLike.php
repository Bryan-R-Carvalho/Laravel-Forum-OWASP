<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comentario;
use Illuminate\Support\Facades\DB;

class RespostaLike extends Component
{
    public $resposta;
    public $likes;
    public $hasLiked;

    public function mount($resposta){
        $this->resposta = $resposta;
        $this->likes = $this->countLikes($resposta->id);
        $this->hasLiked = $this->hasLiked($resposta->id);
    }
    
    public function like($id):void{
        $resposta = Comentario::findOrFail($id);
        $user_id = auth()->user()->id;

        $hasLiked = $this->hasLiked($id);
           
        if (!$hasLiked) {
            $resposta->likes()->attach($user_id);
        } else {
            $resposta->likes()->detach($user_id);
        }

            $this->hasLiked = $this->hasLiked($id);
            $this->likes = $this->countLikes($id);
    }

    public function hasLiked($id):bool{
        if(!auth()->check()){
            return false;
        }
        $user_id = auth()->user()->id;
        $hasLiked = DB::table('comentarios_like')
            ->where('comentario_id', $id)
            ->where('user_id', $user_id)
            ->exists();
        if($hasLiked){
            return true;
        }
        return false;
    }

    public function countLikes($id){
        $users_like = DB::table('comentarios_like')
            ->where('comentario_id', $id)
            ->count();
        return $users_like;

    }
    public function render()
    {
        return view('livewire.resposta-like');
    }
}
