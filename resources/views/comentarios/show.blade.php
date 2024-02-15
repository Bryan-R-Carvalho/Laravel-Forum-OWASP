@extends('template.layout')
@section('title', 'Twyter')
@section('body')
    <div class="bg-gray-900 min-h-screen p-6 pt-16">
        <div class="grid grid-cols-3 gap-8">
            <div>
                <div class="bg-gray-800 p-5 rounded-lg shadow-lg col-span-1">
                    @auth
                        <form action="{{ route('comentario.resposta', [$comentario->id]) }}" method="POST" class="flex flex-col items-center">
                            @method('POST')
                            @csrf
                            <div>
                                <label for="comentario" class="block text-white font-bold mb-2">Comentário</label>
                                <textarea name="conteudo" id="comentario" maxlength="120" rows="5" cols="40" class="w-full p-2 border bg-gray-700 text-white rounded-md"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md">Enviar</button>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>

            <div>
                <div class="bg-gray-800 p-5 mb-4 rounded-lg shadow-md max-w-xl">
                    <div class="text-white mb-2"> {{$comentario->conteudo}}</div>
                    <small class="text-blue-400">{{$comentario->name}} |</small>
                    <small class="text-blue-400">{{ \Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y H:i') }} |</small>
                    <livewire:like-button :key="$comentario->id" :$comentario />

                </div>
                @php $respostas = DB::table('comentarios')->where('comentario_id', $comentario->id)->get(); @endphp
                <div class="pl-5">
                    @foreach($respostas as $resposta)
                    <div class="bg-gray-800 p-5 mb-4 rounded-lg shadow-md max-w-xl">
                        <div class="text-white mb-2"> {{$resposta->conteudo}}</div>
                        <small class="text-blue-400">{{ \Carbon\Carbon::parse($resposta->created_at)->format('d/m/Y H:i') }} |</small>
                        <small class="text-blue-400" ><button >&#10084;</button> ( {{$resposta->likes}} ) |</small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  
@endsection