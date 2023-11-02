<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Comentario,
    User
};

class UserController extends Controller
{
   
    public function __construct(
        protected User $user
    ){}
    public function seguidores()
    {
        $user = auth()->user();
        $seguidores = DB::table('seguidores')->where('seguidor_id', $user->id)->get();
        $seguidores = $seguidores->map(function($seguidor){
            return $this->user->find($seguidor->seguidor_id);
        });
        return view('dashboard', compact('seguidores'));

    }
    public function seguir($id){
        $user = auth()->user();
        $user = auth()->user()->id;
       if(DB::table('seguidores')->where('seguidor_id', $user)->where('seguido_id', $id)->doesntExist()){
        DB::table('seguidores')->insert([
            'seguidor_id' => $user,
            'seguido_id' => $id
        ]);
         }
         

        return back();
    }
}