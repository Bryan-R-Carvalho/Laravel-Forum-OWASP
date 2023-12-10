<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\{
    Seguidor,
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
        $seguidores = DB::table('seguidores')
            ->where('seguidor_id', $user->id)
            ->paginate(10);
        // $seguidores = $seguidores->map(function($seguidor){
        //     return $this->user->find($seguidor->seguidor_id);
        // });
        
        return view('dashboard', compact('seguidores'));

    }
    // public function seguir($id){
    //     $user = auth()->user()->id;
    //     if(DB::table('seguidores')->where('seguidor_id', $user)->where('seguido_id', $id)->doesntExist()){
    //         try {
    //             // Tentativa de inserção na tabela
    //             DB::table('seguidores')->insert([
    //                 'seguidor_id' => $user,
    //                 'seguido_id' => $id
    //             ]);
    //         } catch (\Exception $e) {

    //             // Caso ocorra algum erro, retorna para a página anterior
    //             return back();
    //         }
    //     }

    //     return back();
    // }
}