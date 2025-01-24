@extends('layouts.app')

@section('title', 'Category List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Lista de Categorias</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Criar Categoria
    </a>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection