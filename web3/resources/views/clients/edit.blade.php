@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Editar Cliente</h1>
    <a href="{{ route('clients.show', $client->id) }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle"></i> Voltar para as informações
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('clients.update', $client->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Dados do Cliente -->
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $client->name) }}" required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Telefone</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $client->phone) }}">
        @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" value="{{ old('cpf', $client->cpf) }}">
        @error('cpf')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $client->email) }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <h5>Endereço</h5>
    <div class="mb-3">
        <label for="street" class="form-label">Rua</label>
        <input type="text" class="form-control @error('street') is-invalid @enderror" id="street" name="street" value="{{ old('street', $client->address->street) }}">
        @error('street')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="number" class="form-label">Número</label>
        <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number', $client->address->number) }}">
        @error('number')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="neighborhood" class="form-label">Bairro</label>
        <input type="text" class="form-control @error('neighborhood') is-invalid @enderror" id="neighborhood" name="neighborhood" value="{{ old('neighborhood', $client->address->neighborhood) }}">
        @error('neighborhood')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="city" class="form-label">Cidade</label>
        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $client->address->city) }}">
        @error('city')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="state" class="form-label">Estado</label>
        <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state', $client->address->state) }}">
        @error('state')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>
@endsection