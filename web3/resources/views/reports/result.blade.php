@extends('layouts.app')

@section('title', 'Relatório Gerado')

@section('content')
<div class="container mt-5">
    <h1 class="h3 mb-4">Relatório Gerado</h1>

    <!-- Tabela para exibir os dados do relatório -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade Retirada</th>
                    <th>Cliente</th>
                    <th>Data da Retirada</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($withdrawals as $withdrawal)
                <tr>
                    <td>{{ $withdrawal->product_name }}</td>
                    <td>{{ $withdrawal->quantity }}</td>
                    <td>{{ $withdrawal->client_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($withdrawal->withdrawal_date)->format('d/m/Y H:i') }}</td>
                    <td>R$ {{ number_format($withdrawal->total_value, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Caso o relatório não tenha registros -->
    @if ($withdrawals->isEmpty())
    <div class="alert alert-warning" role="alert">
        Nenhum relatório encontrado para o período selecionado.
    </div>
    @endif
</div>
@endsection