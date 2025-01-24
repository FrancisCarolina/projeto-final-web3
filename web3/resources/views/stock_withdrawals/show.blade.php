{{-- resources/views/stock_withdrawals/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detalhes da Baixa no Estoque</h1>
        <a href="{{ route('stock_withdrawals.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle"></i> Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Cliente: {{ $withdrawal->client->name }}</h4>
            <p>Data da Baixa: {{ $withdrawal->withdrawal_date }}</p>
        </div>
        <div class="card-body">
            <h5>Produtos Baixados:</h5>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Preço Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdrawal->withdrawalProducts as $withdrawalProduct)
                    <tr>
                        <td>{{ $withdrawalProduct->product->nome }}</td>
                        <td>{{ $withdrawalProduct->quantity }}</td>
                        <td>{{ number_format($withdrawalProduct->product->valor_unitario, 2, ',', '.') }}</td>
                        <td>{{ number_format($withdrawalProduct->total_value, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p><strong>Valor Total: </strong>{{ number_format($withdrawal->total_value, 2, ',', '.') }}</p>
        </div>
    </div>
</div>
@endsection