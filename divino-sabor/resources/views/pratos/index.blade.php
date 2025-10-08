<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nosso Cardápio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold">Nosso Cardápio</h1>
                @auth
                    <a href="{{ route('pratos.create') }}" class="btn-custom">Adicionar Novo Prato</a>
                @endauth
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($pratos as $prato)
                    <a href="{{ route('pratos.show', $prato) }}" class="card-prato block hover:no-underline">
                        {{-- Se a imagem existir, mostre-a --}}
                        @if($prato->imagem)
                            <img src="{{ asset('storage/' . $prato->imagem) }}" alt="{{ $prato->nome }}" class="card-prato-imagem">
                        @else
                            {{-- Imagem placeholder se não houver imagem --}}
                            <img src="https://via.placeholder.com/400x250.png?text=Sem+Imagem" alt="Sem imagem" class="card-prato-imagem">
                        @endif

                        <div class="card-prato-corpo">
                            <h2 class="card-prato-titulo">{{ $prato->nome }}</h2>
                            <p class="text-gray-600">{{ Str::limit($prato->descricao, 100) }}</p>
                            <p class="card-prato-preco">R$ {{ number_format($prato->preco, 2, ',', '.') }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3">
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                            <p>Nenhum prato cadastrado ainda.</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>