<div>
    @forelse ($this->comentarios as $comentario)
        @if($comentario->ativo == true)
            <div class="bg-gray-800 p-5 mb-4 rounded-lg shadow-md max-w-xl">
                <div class="text-white mb-2"> {{$comentario->conteudo}}</div>
                <small class="text-blue-400">{{$comentario->user->name}} |</small>
                <small class="text-blue-400">{{ \Carbon\Carbon::parse($comentario->created_at)->format('d/m/Y H:i') }} |</small>

                <div class="text-blue-400">
                    @auth
                        @if($this->hasLiked($comentario->id))
                                <button wire:click="like({{$comentario->id}})" >&#10084;</button>
                                <span>({{ $comentario->likes }})</span>
                            @else
                                <button wire:click="like({{$comentario->id}})" >🤍</button>
                                <span>({{ $comentario->likes }})</span>
                        @endif
                        <a href="{{ route('comentario.show', $comentario->id) }}" >Responder</a>
                    @else
                        <a href="{{ route('login') }}" >🤍</a>
                        <span>({{ $comentario->likes }})</span>
                    @endauth
                </div>

                @can('desativar-comentario')
                    <form action="{{ route('comentario.desativar', $comentario->id) }}" method="POST">
                        @method('POST')
                        @csrf
                        <button type="submit" class="p-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-md">
                            Desativar
                        </button>
                    </form>
                @endcan
            </div>
        @endif
    @empty
        <p>No Posts Found</p>
    @endforelse
    <div x-intersect.full="$wire.loadMore()" class="p-4">
        <div wire:loading wire:target="loadMore" 
            class="loading-indicator">
                Loading more posts...  
        </div>
    </div>
    
</div>