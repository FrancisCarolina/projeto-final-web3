{{-- resources/views/stock_withdrawals/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Baixas no Estoque</h1>
        <!-- Botão para Realizar Venda -->
        <a href="{{ route('stock_withdrawals.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Realizar Venda
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if($withdrawals->isEmpty())
    <p>Não há baixas registradas no estoque.</p>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Data de Baixa</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdrawals as $withdrawal)
                <tr>
                    <td>{{ $withdrawal->client->name }}</td>
                    <td>{{ $withdrawal->withdrawal_date }}</td>
                    <td>{{ number_format($withdrawal->total_value, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection