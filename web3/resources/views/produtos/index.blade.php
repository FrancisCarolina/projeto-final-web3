@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<h1>Produtos</h1>
<a href="{{ route('produtos.create') }}" class="btn btn-primary">Adicionar Produto</a>

<table class="table mt-3">
    <thead>
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
            <td>{{ number_format($produto->valor_unitario, 2, ',', '.') }}</td>
            <td>
                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection