@extends('layouts.app')

@section('title', 'Detalhes da Unidade')

@section('content')
<div class="container">
    <h1>Detalhes da Unidade</h1>

    <div class="card">
        <div class="card-header">
            <h4>{{ $unidade->sigla }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Sigla:</strong> {{ $unidade->sigla }}</p>
            <p><strong>Descrição:</strong> {{ $unidade->descricao }}</p>
        </div>
    </div>

    <a href="{{ route('unidades.index') }}" class="btn btn-primary mt-3">Voltar para a lista</a>
</div>
@endsection