@extends('layouts.app')

@section('title', 'Criar Cliente')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Cabeçalho -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Criar Cliente</h1>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Voltar para a lista</a>
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
        <form action="{{ route('clients.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
            @csrf
            <h5 class="text-primary">Informações Pessoais</h5>
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome Completo" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="xxxxx-xxxx" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@email.com" required>
            </div>

            <hr>
            <h5 class="text-primary">Endereço</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="address[cep]" placeholder="CEP" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="street" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="street" name="address[street]" placeholder="Rua" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="neighborhood" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="neighborhood" name="address[neighborhood]" placeholder="Bairro" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="city" name="address[city]" placeholder="Cidade" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="state" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="state" name="address[state]" placeholder="Estado" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="number" class="form-label">Número</label>
                    <input type="text" class="form-control" id="number" name="address[number]" placeholder="Número" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="complement" class="form-label">Compelemto</label>
                    <input type="text" class="form-control" id="complement" name="address[complement]" placeholder="Opcional">
                </div>
            </div>

            <!-- Botão de submissão -->
            <button type="submit" class="btn btn-primary w-100">Salvar Cliente</button>
        </form>
    </div>
</div>
@endsection