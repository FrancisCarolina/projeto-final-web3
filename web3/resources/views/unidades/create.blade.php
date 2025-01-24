@extends('layouts.app')

@section('title', 'Criar Unidade')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Cabeçalho -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Criar Unidade</h1>
            <a href="{{ route('unidades.index') }}" class="btn btn-secondary">Voltar para a lista</a>
        </div>

        <!-- Exibição de erros -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulário -->
        <form action="{{ route('unidades.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
            @csrf
            <h5 class="text-primary">Informações da Unidade</h5>
            <div class="mb-3">
                <label for="sigla" class="form-label">Sigla</label>
                <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Sigla da Unidade" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição da Unidade" required>
            </div>

            <!-- Botão de submissão -->
            <button type="submit" class="btn btn-primary w-100">Salvar Unidade</button>
        </form>
    </div>
</div>
@endsection