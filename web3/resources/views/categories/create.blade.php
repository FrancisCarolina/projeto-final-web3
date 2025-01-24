@extends('layouts.app')

@section('title', 'Criar Categoria')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Cabeçalho -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Criar Categoria</h1>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Voltar para a lista</a>
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
        <form action="{{ route('categories.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
            @csrf
            <h5 class="text-primary">Categoria</h5>
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Descrição"></textarea>
            </div>

            <!-- Botão de submissão -->
            <button type="submit" class="btn btn-primary w-100">Salvar Categoria</button>
        </form>
    </div>
</div>
@endsection