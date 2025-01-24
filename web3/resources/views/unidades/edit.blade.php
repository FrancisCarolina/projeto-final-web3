@extends('layouts.app')

@section('title', 'Editar Unidade')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Editar Unidade</h1>
        <a href="{{ route('unidades.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Voltar para as informações
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('unidades.update', $unidade->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Sigla da Unidade -->
        <div class="mb-3">
            <label for="sigla" class="form-label">Sigla</label>
            <input type="text" class="form-control @error('sigla') is-invalid @enderror" id="sigla" name="sigla" value="{{ old('sigla', $unidade->sigla) }}" required>
            @error('sigla')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Descrição da Unidade -->
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" value="{{ old('descricao', $unidade->descricao) }}" required>
            @error('descricao')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botões de Ação -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="{{ route('unidades.show', $unidade->id) }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
@endsection