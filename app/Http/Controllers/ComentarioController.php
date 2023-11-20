<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\{
    Comentario,
    User
};

use function Pest\Laravel\json;

class ComentarioController extends Controller
{

    public function __construct(
        protected Comentario $comentario
    ){}

    public function index(){
        $comentarios = DB::table('comentarios')
            ->join('users', 'comentarios.id_user', '=', 'users.id')
            ->select('comentarios.*', 'users.name')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home', compact('comentarios'));
    }
    public function show($id){
        try{
            $comentario = $this->comentario->find($id);
        return view('comentarios.show', compact('comentario'));
        }catch(\Exception $e){
            return json($e, 500);
        }
        
    }
    public function create(){
        return view('comentarios.create');
    }
    public function store(Request $request){
        $user = auth()->user()->id;
        $request->validate([
            'conteudo' => 'required|max:120'
        ]);
        $request->merge(['id_user' => $user,'likes' => 0, 'id_comentario' => null]);
       
        $this->comentario->create($request->all());

        return back();
    }   

    public function edit($id){
        $comentario = $this->comentario->find($id);
        return view('comentarios.edit', compact('comentario'));
    }
    
    public function update(Request $request, $id){
        $this->comentario->find($id)->update($request->all());
        return redirect()->route('comentarios.index');
    }
    public function destroy($id){
        $this->comentario->find($id)->delete();
        return redirect()->route('comentarios.index');
    }
    public function desativar($id){
        $this->comentario->find($id)->update(['ativo' => false]);
        return redirect()->route('comentarios.index');
    }
    public function like($id){
        $comentario = $this->comentario->find($id);
        $comentario->update(['likes' => $comentario->likes + 1]);
        return redirect()->route('comentarios.index');
    }
    // public function resposta(Request $request, $id){
    //     //dd($request->all());
    //     $user = auth()->user()->id;
    //     $comentario = $this->comentario->find($id);
    //     //dd($comentario->id);
    //     $request->validate([
    //         'conteudo' => 'required|max:120'
    //     ]);
    //     $request->merge(['id_user' => $user,'likes' => 0, 'id_comentario' => $comentario->id]);
       
    //     $this->comentario->create($request->all());

    //     return back();
    // }
}
