<div class="text-blue-400">

@auth
    <button wire:click="like({{$comentario->id}})" class="btn btn-outline-primary" style="transition: color 0.3s;" >&#10084;</button>
    <span>({{ $likes }})</span>
    <a href="{{ route('comentario.show', $comentario->id) }}" >Responder</a>

@elseauth
    <span>&#10084;</span>
    <span>({{ $likes }})</span>

@endauth

</div>
