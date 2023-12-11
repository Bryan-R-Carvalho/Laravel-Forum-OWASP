<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{
    User,
    Seguidor
};

class SeguidoresController extends Controller
{
    public function __construct(
        protected User $user,
        protected Seguidor $seguidor
    ){}
    public function seguidores()
    {
        $user = auth()->user()->id;
        $seguidores = Seguidor::where('seguidor_id', $user)
            ->join('users', 'seguidores.seguido_id', '=', 'users.id')
            ->paginate(10);
        
        return view('dashboard', compact('seguidores'));

    }
    public function store($id){
        $user = auth()->user()->id;
        $seguidorExistente = $this->seguidor
        ->where('seguidor_id', $user)
        ->where('seguido_id', $id)
        ->first();

    if($seguidorExistente){
        $seguidorExistente->update(['aceitado' => true]);

    }else{
        $this->seguidor->create([
            'seguidor_id' => $user,
            'seguido_id' => $id,
            'aceitado' => false
        ]);
    }
        return back();
    }
}
