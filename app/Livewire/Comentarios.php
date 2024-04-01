<?php

namespace App\Livewire;
use Livewire\Attributes\Computed;  
use Illuminate\Support\Collection; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Comentario;

class Comentarios extends Component
{
    public int $amount = 10;
    public $likes;
    public $hasLiked;

    #[Computed]
    public function comentarios(): Collection
    {
        return Comentario::with('user')
            ->where('comentario_id', null)
            ->orderBy('created_at', 'desc')
            ->take($this->amount)
            ->get();
    }
    
    public function loadMore(): void{
        $this->amount += 5;
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
        $comentarios = $this->comentarios();

        return view('livewire.comentarios', ['comentarios' => $comentarios]);
    }
}
