<!-- resources/views/clients/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Cabeçalho da página -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Lista de Clientes</h1>
        <a href="{{ route('clients.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Criar Cliente
        </a>
    </div>

    <!-- Campo de filtro -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar cliente pelo nome...">
    </div>

    <!-- Tabela de clientes -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="clientsTable">
                @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->cpf }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>
                        <!-- Ícones de Ação -->
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm" title="Informações">
                            <i class="bi bi-info-circle"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<!-- Script para filtro -->
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#clientsTable tr');

        rows.forEach(row => {
            const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            if (name.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection