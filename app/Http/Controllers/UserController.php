<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\{
    User
};

class UserController extends Controller
{
   
    public function __construct(
        protected User $user
    ){}

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