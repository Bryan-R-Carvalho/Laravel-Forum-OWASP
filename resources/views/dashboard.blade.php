<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('comentarios.index') }}" >Home</a>
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800  ">

            <form action="{{ route('seguir.show', 'search') }}" method="GET" class="p-6 pt-16">
                <div class="flex flex-col place-items-end">
                    <label for="search" class="block text-white font-bold mb-2  me-2 ">Pesquisar nome ou email</label>
                    <input type="text" name="search" id="search" class="w-40 p-2 m-2 mb-2 border bg-gray-700 text-white rounded-md" placeholder=Usuário>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 me-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md">Pesquisar</button>
                </div>

            <table cellpadding="20">
                <tr>
                    <!-- First Column -->
                    <td valign="top">
                        <h2 class="text-white mb-2">Seguidores</h2>
                        @foreach ($seguidores as $seguidor)
                            <div class=" bg-gray-800 p-5 mb-4 rounded-lg shadow-2xl">
                                <form action="{{ route('seguir.destroy', $seguidor->id)}}" method="POST" class="flex flex-col items-center">
                                    @csrf
                                    @method('DELETE')
                                    <div class="text-white mb-2">{{$seguidor->name}}</div>
                                    <small class="text-blue-400">{{$seguidor->email}}</small>
                                    <button type="submit" class="text-white hover:text-blue-400 mt-2">Desfazer</button>
                                </form>
                            </div>
                        @endforeach
                    </td>
                    <td valign="top">
                        <h2 class="text-white mb-2">Usuários</h2>
                        @foreach ($sugestoes as $sug)
                            <div class="bg-gray-800 p-5 mb-4 rounded-lg shadow-2xl ">
                                <form action="{{ route('seguir.store', $sug->id)}}" method="POST" class="flex flex-col items-center">
                                    @csrf
                                    @method('POST')
                                    
                                    <div class="text-white mb-2">{{$sug->name}}</div>
                                    <small class="text-blue-400">{{$sug->email}}</small>
                                    <button type="submit" class="text-white hover:text-blue-400 mt-2">Seguir</button>
                                </form>
                            </div>
                        @endforeach
                    </td>
                </tr>
            </table>
            <div class="d-flex justify-content-center mt-5">
                {{ $sugestoes->links()}}
            </div>
        </div>
    </div>

</x-app-layout>
