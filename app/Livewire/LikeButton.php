<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeButton extends Component
{  
    public $comentario;
    public $likes;
    public $hasLiked;

    public function mount($comentario){
        $this->comentario = $comentario;
        $this->likes = $comentario->likes;
        $this->hasLiked = $this->hasLiked($comentario->id);
    }
    
    public function like($id):void{
        try{
            $comentario = Comentario::findOrFail($id);
            $user_id = Auth::user()->id;
               
            if (!$this->hasLiked) {
                $comentario->likes()->attach($user_id);
                $comentario->increment('likes');
            } else {
                $comentario->likes()->detach($user_id);
                $comentario->decrement('likes');
            }

            $this->hasLiked = $this->hasLiked($id);
            $this->likes = $comentario->likes;

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
           redirect()->route('home')->with('error', 'Comentário não encontrado');
        }
    }
    
    public function hasLiked($id):bool{
        if(!Auth::check()){
            return false;
        }
        $user_id = Auth::user()->id;
        $hasLiked = DB::table('comentarios_like')
            ->where('comentario_id', $id)
            ->where('user_id', $user_id)
            ->exists();

        if($hasLiked){
            return true;
        }
        return false;
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
