@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Editar Categoria</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Voltar para as informações
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nome da Categoria -->
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Descrição da Categoria -->
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botões de Ação -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
@endsection