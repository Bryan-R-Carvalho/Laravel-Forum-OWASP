<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('comentarios.index') }}" >Home</a>
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800  ">
            <table cellpadding="20">
                <tr>
                    <!-- First Column -->
                    <td valign="top">
                        <h2 class="text-white mb-2">Seguidores</h2>
                        <!-- @php
                            $users = DB::table('users')
                                ->select('users.name', 'users.email')
                                ->join('seguidores', 'users.id', '=', 'seguidores.seguidor_id')
                                ->where('seguidores.seguido_id', '=', Auth::user()->id)
                                ->where('seguidores.aceitado', '=', true)
                                ->get();
                        @endphp -->
                        @foreach ($seguidores as $seguidores)
                            <div class=" bg-gray-800 p-5 mb-4 rounded-lg shadow-2xl">
                                <div class="text-white mb-2">{{$seguidores->name}}</div>
                                <small class="text-blue-400">{{$seguidores->email}}</small>
                            </div>
                        @endforeach
                    </td>
                    <td valign="top">
                        @php
                            $sugest = DB::table('users')
                                ->select('users.id', 'users.name', 'users.email')
                                ->leftJoin('seguidores', function($join) {
                                    $join->on('users.id', '=', 'seguidores.seguidor_id')
                                        ->where('seguidores.seguidor_id', '=', Auth::user()->id);
                                })
                                ->whereNull('seguidores.id')
                                ->where('users.id', '!=', Auth::user()->id)  // Não mostrar o usuário atual
                                ->orderBy('users.name')
                                ->paginate(15);
                        @endphp
                        <h2 class="text-white mb-2">Sugestões de usuários para seguir</h2>
                        @foreach ($sugest as $sug)
                            <div class="bg-gray-800 p-5 mb-4 rounded-lg shadow-2xl ">
                                <form action="{{ route('seguir.store', $sug->id)}}" method="POST" class="flex flex-col items-center">
                                    @csrf
                                    @method('POST')
                                    
                                    <input type="hidden" name="id" value="{{$sug->id}}">
                                    <div class="text-white mb-2">{{$sug->name}}</div>
                                    <small class="text-blue-400">{{$sug->email}}</small>
                                    <button type="submit" class="text-white ">Seguir</button>
                                </form>
                            </div>
                        @endforeach
                    </td>
                </tr>
            </table>
            <div class="d-flex justify-content-center mt-5">
                {{ $sugest->links()}}
            </div>
        </div>
    </div>

</x-app-layout>
