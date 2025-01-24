<!-- resources/views/produtos/index.blade.php -->
@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
<div class="container mt-5">
    <!-- Cabeçalho da página -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Lista de Produtos</h1>
        <a href="{{ route('produtos.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Criar Produto
        </a>
    </div>

    <!-- Tabela de produtos -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Unidade</th>
                    <th>Estoque</th>
                    <th>Valor Unitário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->categoria->name }}</td>
                    <td>{{ $produto->unidadeMedida->sigla }}</td>
                    <td>{{ $produto->estoque }}</td>
                    <td>R$ {{ number_format($produto->valor_unitario, 2, ',', '.') }}</td>
                    <td>
                        <!-- Ícones de Ação -->
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection