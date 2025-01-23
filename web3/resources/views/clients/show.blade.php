<!-- resources/views/clients/show.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Cabeçalho da página -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Informações do Cliente</h1>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Voltar para a lista
            </a>
        </div>

        <!-- Detalhes do Cliente -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Cliente: {{ $client->name }}</h5>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $client->id }}</p>
                <p><strong>Telefone:</strong> {{ $client->phone }}</p>
                <p><strong>CPF:</strong> {{ $client->cpf }}</p>
                <p><strong>E-mail:</strong> {{ $client->email }}</p>
                <p><strong>Endereço:</strong> {{ $client->address->street }}, {{ $client->address->number }}<br>
                    {{ $client->address->neighborhood }} - {{ $client->address->city }}/{{ $client->address->state }}
                </p>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $client->id }}">
                    <i class="bi bi-trash"></i> Excluir
                </button>
            </div>
        </div>

        <!-- Modal de confirmação de exclusão -->
        <div class="modal fade" id="deleteModal{{ $client->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $client->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $client->id }}">Confirmar Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza de que deseja excluir este cliente?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>