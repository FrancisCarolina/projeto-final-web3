@extends('layouts.app')

@section('title', 'Unidades')

@section('content')
<div class="container">
    <h1>Unidades</h1>
    <a href="{{ route('unidades.create') }}" class="btn btn-primary mb-3">Criar Unidade</a>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Sigla</th>
                <th scope="col">Descrição</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unidades as $unidade)
            <tr>
                <td>{{ $unidade->sigla }}</td>
                <td>{{ $unidade->descricao }}</td>
                <td>
                    <a href="{{ route('unidades.edit', $unidade->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('unidades.destroy', $unidade->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection