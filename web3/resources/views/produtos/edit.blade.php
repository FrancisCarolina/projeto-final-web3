@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
<h1>Editar Produto</h1>
<form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}" required>
    </div>

    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-control" id="categoria_id" name="categoria_id" required>
            <option value="">Selecione</option>
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ $produto->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="unidade_medida_id" class="form-label">Unidade de Medida</label>
        <select class="form-control" id="unidade_medida_id" name="unidade_medida_id" required>
            <option value="">Selecione</option>
            @foreach ($unidadesMedida as $unidade)
            <option value="{{ $unidade->id }}" {{ $produto->unidade_medida_id == $unidade->id ? 'selected' : '' }}>{{ $unidade->sigla }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="estoque" class="form-label">Estoque</label>
        <input type="number" class="form-control" id="estoque" name="estoque" value="{{ $produto->estoque }}" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3" required>{{ $produto->descricao }}</textarea>
    </div>

    <div class="mb-3">
        <label for="valor_unitario" class="form-label">Valor Unitário</label>
        <input type="number" class="form-control" id="valor_unitario" name="valor_unitario" value="{{ $produto->valor_unitario }}" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="imagem" class="form-label">Imagem</label>
        <input type="file" class="form-control" id="imagem" name="imagem">
        @if ($produto->caminho_imagem)
        <img src="{{ asset('storage/'.$produto->caminho_imagem) }}" alt="Imagem do produto" width="100">
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection