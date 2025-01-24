@extends('layouts.app')

@section('title', 'Adicionar Produto')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Cabeçalho -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Adicionar Produto</h1>
            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar para a lista</a>
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
        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
            @csrf
            <h5 class="text-primary">Informações do Produto</h5>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto" required>
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
                <input type="number" class="form-control" id="estoque" name="estoque" placeholder="Quantidade em estoque" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Descrição do Produto" required></textarea>
            </div>

            <div class="mb-3">
                <label for="valor_unitario" class="form-label">Valor Unitário</label>
                <input type="number" class="form-control" id="valor_unitario" name="valor_unitario" step="0.01" placeholder="Valor Unitário" required>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
            </div>

            <!-- Botão de submissão -->
            <button type="submit" class="btn btn-primary w-100">Salvar Produto</button>
        </form>
    </div>
</div>
@endsection