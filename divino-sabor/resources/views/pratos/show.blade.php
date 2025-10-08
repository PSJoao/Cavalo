@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden lg:flex">
        <img src="{{ asset('storage/' . $prato->imagem) }}" alt="{{ $prato->nome }}" class="lg:w-1/3 w-full h-80 object-cover">
        <div class="p-8 lg:w-2/3">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $prato->nome }}</h1>
            <p class="text-gray-700 text-lg mb-4">{{ $prato->descricao }}</p>
            <p class="text-3xl font-bold text-green-600 mb-6">R$ {{ number_format($prato->preco, 2, ',', '.') }}</p>

            <div class="flex items-center space-x-4">
                @auth
                    {{-- Formulário para Adicionar ao Carrinho --}}
                    <form action="{{ route('carrinho.adicionar', $prato) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                            Adicionar ao Carrinho
                        </button>
                    </form>

                    {{-- Botões de Ação para o Dono do Prato --}}
                    @if(Auth::user()->id == $prato->user_id)
                        <a href="{{ route('pratos.edit', $prato) }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-300">Editar</a>
                        <form action="{{ route('pratos.destroy', $prato) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">Excluir</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                        Faça login para comprar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection