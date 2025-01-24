@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Relatório de Produtos com Estoque</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>Unidade</th>
                <th>Categoria</th>
                <th>Quantidade</th>
                <th>% Restante</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->nome }}</td>
                <td>{{ $product->unidadeMedida->sigla }}</td>
                <td>{{ $product->categoria->name }}</td>
                <td>{{ $product->estoque }}</td>
                <td>{{ $product->remaining_percentage }}%</td> <!-- Exibindo a porcentagem de estoque restante -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection