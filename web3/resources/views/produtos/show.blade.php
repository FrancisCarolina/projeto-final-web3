@extends('layouts.app')

@section('title', 'Detalhes do Produto')

@section('content')
<h1>Detalhes do Produto</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $produto->nome }}</h5>
        <p class="card-text"><strong>Categoria:</strong> {{ $produto->categoria->nome }}</p>
        <p class="card-text"><strong>Unidade de Medida:</strong> {{ $produto->unidadeMedida->nome }}</p>
        <p class="card-text"><strong>Estoque:</strong> {{ $produto->estoque }}</p>
        <p class="card-text"><strong>Valor Unitário:</strong> R$ {{ number_format($produto->valor_unitario, 2, ',', '.') }}</p>
        <p class="card-text"><strong>Descrição:</strong> {{ $produto->descricao }}</p>
        @if ($produto->caminho_imagem)
        <img src="{{ asset('storage/'.$produto->caminho_imagem) }}" alt="Imagem do produto" width="200">
        @endif
    </div>
</div>

<a href="{{ route('produtos.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection