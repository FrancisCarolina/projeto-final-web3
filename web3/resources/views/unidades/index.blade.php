@extends('layouts.app')

@section('title', 'Unidades')

@section('content')
<div class="container mt-5">
    <!-- Cabeçalho da página -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Lista de Unidades</h1>
        <a href="{{ route('unidades.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Criar Unidade
        </a>
    </div>

    <!-- Tabela de unidades -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Sigla</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unidades as $unidade)
                <tr>
                    <td>{{ $unidade->sigla }}</td>
                    <td>{{ $unidade->descricao }}</td>
                    <td>
                        <!-- Ícones de Ação -->
                        <a href="{{ route('unidades.edit', $unidade->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('unidades.destroy', $unidade->id) }}" method="POST" style="display:inline;">
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