<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meu Carrinho') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(empty($carrinho))
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                            <p class="font-bold">Aviso</p>
                            <p>Seu carrinho está vazio.</p>
                        </div>
                    @else
                        <div>
                            @php $total = 0; @endphp
                            @foreach($carrinho as $id => $details)
                                @php $total += $details['preco'] * $details['quantidade']; @endphp
                                <div class="flex items-center justify-between border-b pb-4 mb-4">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $details['imagem']) }}" alt="{{ $details['nome'] }}" class="w-20 h-20 object-cover rounded-md mr-4">
                                        <div>
                                            <h2 class="text-lg font-semibold">{{ $details['nome'] }}</h2>
                                            <p class="text-gray-600">R$ {{ number_format($details['preco'], 2, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-gray-800">Qtd: {{ $details['quantidade'] }}</p>
                                    </div>
                                    <p class="text-lg font-bold">R$ {{ number_format($details['preco'] * $details['quantidade'], 2, ',', '.') }}</p>
                                </div>
                            @endforeach

                            <div class="mt-6 text-right">
                                <h3 class="text-2xl font-bold">Total: R$ {{ number_format($total, 2, ',', '.') }}</h3>
                                <form action="{{ route('carrinho.finalizar') }}" method="POST" class="inline-block mt-4">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                        Finalizar Compra
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>