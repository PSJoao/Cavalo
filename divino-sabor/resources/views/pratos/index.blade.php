@extends('layout')

@section('title', 'Cardápio - Divino Sabor')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Cardápio Divino Sabor</h1>
    <a href="{{ route('pratos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Adicionar Prato
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    @forelse ($pratos as $prato)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/' . $prato->imagem) }}" class="card-img-top" alt="{{ $prato->nome }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $prato->nome }}</h5>
                    <p class="card-text">{{ $prato->descricao }}</p>
                    <h4 class="mt-auto">R$ {{ number_format($prato->preco, 2, ',', '.') }}</h4>
                </div>
                <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                    <a href="{{ route('pratos.edit', $prato) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Editar
                    </a>
                    <form action="{{ route('pratos.destroy', $prato) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este prato?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash3"></i> Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col">
            <div class="alert alert-info">Nenhum prato cadastrado ainda.</div>
        </div>
    @endforelse
</div>

@endsection