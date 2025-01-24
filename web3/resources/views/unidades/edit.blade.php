@extends('layouts.app')

@section('title', 'Editar Unidade')

@section('content')
<div class="container">
    <h1>Editar Unidade</h1>
    <form action="{{ route('unidades.update', $unidade->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="sigla" class="form-label">Sigla</label>
            <input type="text" class="form-control" id="sigla" name="sigla" value="{{ $unidade->sigla }}" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $unidade->descricao }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection