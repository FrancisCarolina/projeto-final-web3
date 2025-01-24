@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Relatório de Retiradas Agrupadas por Período</h2>

    @foreach($withdrawals as $withdrawal)
    <div>
        <h4>Cliente: {{ $withdrawal->client->name }}</h4>
        <p>Data da Retirada: {{ $withdrawal->withdrawal_date }}</p>
        <p>Valor Total: {{ number_format($withdrawal->total_value, 2, ',', '.') }}</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade Retirada</th>
                    <th>Unidade</th>
                    <th>Categoria</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdrawal->withdrawalProducts as $withdrawalProduct)
                <tr>
                    <td>{{ $withdrawalProduct->product->nome }}</td>
                    <td>{{ $withdrawalProduct->quantity }}</td>
                    <td>{{ $withdrawalProduct->product->unidadeMedida->sigla }}</td>
                    <td>{{ $withdrawalProduct->product->categoria->name }}</td>
                    <td>{{ number_format($withdrawalProduct->total_value, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</div>
@endsection