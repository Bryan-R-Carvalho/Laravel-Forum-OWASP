<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{
    User,
    Seguidor
};
use Illuminate\Support\Facades\Auth;

class SeguidoresController extends Controller
{
    public function __construct(
        protected User $user,
        protected Seguidor $seguidor
    ){}

    public function index()
    {
        $user = Auth::user()->id;

        //$seguidores recebe toos os usuarios que seguem o usuario logado
        $seguidores = User::where('id', '!=', Auth :: user()->id)
            ->where('role', '!=', 'admin')
            ->whereHas('seguidores', function($q) use ($user){
                $q->where(function($query) use ($user) {
                    $query->where('user1_id', $user)
                          ->orWhere('user2_id', $user);
                })
                ->where('aceito', true);
            })
            ->orderBy('name')
            ->paginate(20);

            $sugestoes = User::whereDoesntHave('seguidores', function($query) use ($user) {
                $query->where('aceito', true)
                      ->where(function($query) use ($user) {
                          $query->where('user1_id', $user)
                                ->orWhere('user2_id', $user);
                      });
            })
            ->where('id', '!=', $user)
            ->where('role', '!=', 'admin')
            ->orderBy('name')
            ->paginate(20);
    

        return view('dashboard', compact('seguidores', 'sugestoes'));

    }

    public function store($id){
        $user = Auth::user()->id;

        $a1 = self::getSeguidores($user, $id);
        $a2 = self::getSeguidores($id, $user);

        if(!$a1 && !$a2){
            try {
                // Tentativa de inserção na tabela
                DB::table('seguidores')->insert([
                    'user1_id' => $user,
                    'user2_id' => $id
                ]);
            } catch (\Exception $e) {

                // Caso ocorra algum erro, retorna para a página anterior
                return back();
            }
        }else if($a1 && !$a2){
            DB::table('seguidores')->where('user1_id', $user)->where('user2_id', $id)->update(['aceito' => true]);
        }else if(!$a1 && $a2){
            DB::table('seguidores')->where('user1_id', $id)->where('user2_id', $user)->update(['aceito' => true]);
        }
        return back();
    }
    
    //faz função para buscar o usuario pelo nome ou email
    public function search(Request $request){
        $user = Auth::user()->id;
        $search = $request->search;

        $seguidores = User::where('id', '!=', $user)
        ->where('role', '!=', 'admin')
        ->where(function($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        })
        ->whereHas('seguidores', function($q) use ($user){
            $q->where(function($query) use ($user) {
                $query->where('user1_id', $user)
                      ->orWhere('user2_id', $user);
            })
            ->where('aceito', true);
        })
        ->orderBy('name')
        ->paginate(20);

        $sugestoes = User::where('id', '!=', $user)
        ->where('role', '!=', 'admin')
        ->whereDoesntHave('seguidores', function($query) use ($user) {
            $query->where('aceito', true)
                ->where(function($query) use ($user) {
                    $query->where('user1_id', $user)
                        ->orWhere('user2_id', $user);
                });
        })
        ->where(function($query) use ($search) {
        $query->where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%");
        })
        ->paginate(20);

        
        return view('dashboard', compact('seguidores', 'sugestoes'));
    }

    public function destroy($id){
        $user = Auth::user()->id;
        $a1 = self::getSeguidores($user, $id);
        $a2 = self::getSeguidores($id, $user);

        if($a1 && !$a2){
            DB::table('seguidores')->where('user1_id', $user)->where('user2_id', $id)->delete();
        }else if(!$a1 && $a2){
            DB::table('seguidores')->where('user1_id', $id)->where('user2_id', $user)->delete();
        }
        return back();
    }
    protected function getSeguidores($user, $id):bool{
        return Seguidor::where('user1_id', $user)->orWhere('user2_id', $id)->where('aceito', true)->exists();
    }
}     
            