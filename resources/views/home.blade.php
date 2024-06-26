@extends('template.layout')
@section('title', 'home')
@section('body')
    <div class="bg-gray-900 min-h-screen p-6 pt-16">
        <div class="grid grid-cols-3 gap-8">
            <div class="bg-gray-800 p-5 rounded-lg shadow-lg col-span-1">
                @auth
                    <form action="{{ route('comentario.store') }}" method="POST"
                        class="flex flex-col items-center">
                        @method('POST')
                        @csrf
                        <div>
                            <label for="comentario" class="block text-white font-bold
                                mb-2">Comentário</label>
                            <textarea name="conteudo" id="comentario" maxlength="120"
                                rows="5" cols="40" class="w-full p-2 border bg-gray-700 text-white rounded-md"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-blue-500
                                hover:bg-blue-600 text-white rounded-md shadow-md">Enviar</button>
                        </div>
                    </form>
                @endauth
            </div>

            <livewire:comentarios />
 
        </div>
    </div>
@endsection
