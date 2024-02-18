<div class="text-blue-400">
    @if($hasLiked)
            <button wire:click="like({{$resposta->id}})" >&#10084;</button>
            <span>({{ $likes }})</span>
        @else
            <button wire:click="like({{$resposta->id}})" >🤍</button>
            <span>({{ $likes }})</span>
    @endif
</div>