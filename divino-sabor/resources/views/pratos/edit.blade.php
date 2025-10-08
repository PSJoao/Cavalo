@extends('layout')

@section('title', 'Editar Prato: ' . $prato->nome)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Editar Prato: {{ $prato->nome }}</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
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
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Prato</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $prato->nome) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required>{{ old('descricao', $prato->descricao) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="{{ old('preco', $prato->preco) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Nova Imagem do Prato (opcional)</label>
                        <input class="form-control" type="file" id="imagem" name="imagem">
                        @if ($prato->imagem)
                            <div class="mt-2">
                                <small>Imagem atual:</small><br>
                                <img src="{{ asset('storage/' . $prato->imagem) }}" alt="{{ $prato->nome }}" width="150">
                            </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pratos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Atualizar Prato</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection