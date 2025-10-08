@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl bg-white p-8 shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Editar Prato: {{ $prato->nome }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pratos.update', $prato) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome do Prato</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $prato->nome) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="descricao" class="block text-gray-700 text-sm font-bold mb-2">Descrição</label>
            <textarea name="descricao" id="descricao" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('descricao', $prato->descricao) }}</textarea>
        </div>
        <div class="mb-4">
            <label for="preco" class="block text-gray-700 text-sm font-bold mb-2">Preço</label>
            <input type="number" step="0.01" name="preco" id="preco" value="{{ old('preco', $prato->preco) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-6">
            <label for="imagem" class="block text-gray-700 text-sm font-bold mb-2">Nova Imagem (opcional)</label>
            <input type="file" name="imagem" id="imagem" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @if($prato->imagem)
            <div class="mt-4">
                <p class="text-sm text-gray-600">Imagem Atual:</p>
                <img src="{{ asset('storage/' . $prato->imagem) }}" alt="{{ $prato->nome }}" class="w-32 h-32 object-cover rounded-md mt-2">
            </div>
            @endif
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Atualizar Prato
            </button>
            <a href="{{ route('pratos.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection