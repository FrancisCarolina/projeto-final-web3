@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Editar Produto</h1>
    <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle"></i> Voltar para as informações
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Dados do Produto -->
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $produto->nome) }}" required>
        @error('nome')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-control @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id" required>
            <option value="">Selecione</option>
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ $produto->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->name }}</option>
            @endforeach
        </select>
        @error('categoria_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="unidade_medida_id" class="form-label">Unidade de Medida</label>
        <select class="form-control @error('unidade_medida_id') is-invalid @enderror" id="unidade_medida_id" name="unidade_medida_id" required>
            <option value="">Selecione</option>
            @foreach ($unidadesMedida as $unidade)
            <option value="{{ $unidade->id }}" {{ $produto->unidade_medida_id == $unidade->id ? 'selected' : '' }}>{{ $unidade->sigla }}</option>
            @endforeach
        </select>
        @error('unidade_medida_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="estoque" class="form-label">Estoque</label>
        <input type="number" class="form-control @error('estoque') is-invalid @enderror" id="estoque" name="estoque" value="{{ old('estoque', $produto->estoque) }}" required>
        @error('estoque')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="3" required>{{ old('descricao', $produto->descricao) }}</textarea>
        @error('descricao')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="valor_unitario" class="form-label">Valor Unitário</label>
        <input type="number" class="form-control @error('valor_unitario') is-invalid @enderror" id="valor_unitario" name="valor_unitario" value="{{ old('valor_unitario', $produto->valor_unitario) }}" step="0.01" required>
        @error('valor_unitario')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="imagem" class="form-label">Imagem</label>
        <input type="file" class="form-control @error('imagem') is-invalid @enderror" id="imagem" name="imagem">
        @error('imagem')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if ($produto->caminho_imagem)
        <img src="{{ asset('storage/'.$produto->caminho_imagem) }}" alt="Imagem do produto" width="100">
        @endif
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>
@endsection