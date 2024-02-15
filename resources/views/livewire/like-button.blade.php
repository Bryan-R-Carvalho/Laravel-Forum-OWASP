<div class="text-blue-400">
    @auth
        @if($hasLiked)
                <button wire:click="like({{$comentario->id}})" >&#10084;</button>
                <span>({{ $likes }})</span>
            @else
                <button wire:click="like({{$comentario->id}})" >🤍</button>
                <span>({{ $likes }})</span>
        @endif
        <a href="{{ route('comentario.show', $comentario->id) }}" >Responder</a>
    @else
        <a href="{{ route('login') }}" >🤍</a>
        <span>({{ $likes }})</span>
    @endauth
</div>
