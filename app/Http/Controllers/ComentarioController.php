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
        $request->merge(['id_user' => $user,'likes' => 0, 'id_comentario' => null, 'users_like' => []]);
       
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
        $users_like = collect($comentario->users_like)->sort()->values()->toArray();

        $index = $this->binarySearch($users_like, auth()->user()->id);
        
        if($index === -1){
            $comentario->update(['likes' => $comentario->likes + 1]);
            $users_like[] = auth()->user()->id;

        }else{
            unset($users_like[$index]);
            $comentario->update(['likes' => $comentario->likes - 1]);
            $users_like = array_values($users_like);
        }

        $comentario->update(['users_like' => $users_like]);
        return back();
    }

    public function binarySearch($array, $target) {
        $left = 0;
        $right = count($array) - 1;
        while ($left <= $right) {
            $mid = floor(($left + $right) / 2);

            if ($array[$mid] == $target) {
                return $mid;
            }
            if ($array[$mid] < $target) {
                $left = $mid + 1;
            } else {
                $right = $mid - 1;
            }
        }
        return -1;
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
