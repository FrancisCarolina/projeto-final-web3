<!-- resources/views/produtos/show.blade.php -->
@extends('layouts.app')

@section('title', 'Detalhes do Produto')

@section('content')
<div class="container mt-5">
    <!-- Cabeçalho da página -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detalhes do Produto</h1>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Voltar para a lista
        </a>
    </div>

    <!-- Detalhes do Produto -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Produto: {{ $produto->nome }}</h5>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $produto->id }}</p>
            <p><strong>Categoria:</strong> {{ $produto->categoria->nome }}</p>
            <p><strong>Unidade de Medida:</strong> {{ $produto->unidadeMedida->nome }}</p>
            <p><strong>Estoque:</strong> {{ $produto->estoque }}</p>
            <p><strong>Valor Unitário:</strong> R$ {{ number_format($produto->valor_unitario, 2, ',', '.') }}</p>
            <p><strong>Descrição:</strong> {{ $produto->descricao }}</p>
            @if ($produto->caminho_imagem)
            <img src="{{ asset('storage/'.$produto->caminho_imagem) }}" alt="Imagem do produto" width="200">
            @endif
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Editar
            </a>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $produto->id }}">
                <i class="bi bi-trash"></i> Excluir
            </button>
        </div>
    </div>

    <!-- Modal de confirmação de exclusão -->
    <div class="modal fade" id="deleteModal{{ $produto->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $produto->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $produto->id }}">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir este produto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection