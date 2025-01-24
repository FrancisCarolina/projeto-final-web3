@extends('layouts.app')

@section('title', 'Criar Unidade')

@section('content')
<div class="container">
    <h1>Criar Unidade</h1>
    <form action="{{ route('unidades.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="sigla" class="form-label">Sigla</label>
            <input type="text" class="form-control" id="sigla" name="sigla" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection