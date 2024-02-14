<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comentario;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Reactive;

class LikeButton extends Component
{  
    public $comentario;
    public $likes;

    public function mount($comentario){
        $this->comentario = $comentario;
        $this->likes = $this->countLikes($comentario->id);
    }
    

    public function like($id):void{
        $comentario = Comentario::findOrFail($id);
        $user_id = auth()->user()->id;

        $hasLiked = DB::table('comentarios_like')
            ->where('comentario_id', $id)
            ->where('user_id', $user_id)
            ->exists();
            
        if (!$hasLiked) {
            $comentario->likes()->attach($user_id);
        } else {
            $comentario->likes()->detach($user_id);
        }

        $this->likes = $this->countLikes($id);
        }
    
    public function hasLiked($id){
        $comentario = $this->comentario->find($id);
        $user_id = auth()->user()->id;
        $hasLiked = $comentario->likes()->where('user_id', $user_id)->exists();
        return $hasLiked;
    }
    public function usersLike($id){
        $comentario = $this->comentario->find($id);
        $users_like = $comentario->likes()->pluck('user_id');
        return $users_like;
    }

    public function countLikes($id){
        $users_like = DB::table('comentarios_like')
            ->where('comentario_id', $id)
            ->count();
        return $users_like;

    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
