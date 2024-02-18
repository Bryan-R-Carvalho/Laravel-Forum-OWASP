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
        //Eloquent ORM
        //$comentarios = Comentario::where('comentario_id', null)->where('ativo', true)->orderBy('created_at', 'desc')->paginate(20);

        //DB query builder
        $comentarios = DB::table('comentarios')
            ->join('users', 'comentarios.user_id', '=', 'users.id')
            ->select('comentarios.*', 'users.name')
            ->where('comentario_id', null)
            ->where('ativo', true)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('home', compact('comentarios'));
    }
    public function show($id){
        $comentario = DB::table('comentarios')
            ->join('users', 'comentarios.user_id', '=', 'users.id')
            ->select('comentarios.*', 'users.name')
            ->where('comentario_id', null)
            ->where('comentarios.id', $id)
            ->first();
        
        $respostas = DB::table('comentarios')
            ->join('users', 'comentarios.user_id', '=', 'users.id')
            ->select('comentarios.*', 'users.name')
            ->where('comentario_id', $id)
            ->where('ativo', true)
            ->orderBy('created_at', 'asc') // 'asc' ou 'desc
            ->get();

        return view('comentarios.show', compact('comentario', 'respostas'));
        
    }

    public function store(Request $request){
        $user = auth()->user()->id;
        $request->validate([
            'conteudo' => 'required|max:120'
        ]);
        $request->merge(['user_id' => $user, 'ativo' => true, 'comentario_id' => null]);
       
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

    public function responder(Request $request, $id){
        // Validar os dados do formulário
        $request->validate([
            'conteudo' => 'required|max:120'
        ]);

        // Obter o ID do usuário autenticado
        $user_id = auth()->id();

        // Criar o comentário
        $comentario = Comentario::create([
            'conteudo' => $request->input('conteudo'),
            'user_id' => $user_id,
            'ativo' => true,
            'comentario_id' => $id
        ]);

        // Retornar à página anterior com uma mensagem de sucesso
        return back();
    }

    

}
