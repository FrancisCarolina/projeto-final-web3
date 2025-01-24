@extends('layouts.app')

@section('title', 'Adicionar Produto')

@section('content')
<h1>Adicionar Produto</h1>
<form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-control" id="categoria_id" name="categoria_id" required>
            <option value="">Selecione</option>
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="unidade_medida_id" class="form-label">Unidade de Medida</label>
        <select class="form-control" id="unidade_medida_id" name="unidade_medida_id" required>
            <option value="">Selecione</option>
            @foreach ($unidadesMedida as $unidade)
            <option value="{{ $unidade->id }}">{{ $unidade->sigla }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="estoque" class="form-label">Estoque</label>
        <input type="number" class="form-control" id="estoque" name="estoque" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="valor_unitario" class="form-label">Valor Unitário</label>
        <input type="number" class="form-control" id="valor_unitario" name="valor_unitario" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="imagem" class="form-label">Imagem</label>
        <input type="file" class="form-control" id="imagem" name="imagem">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection