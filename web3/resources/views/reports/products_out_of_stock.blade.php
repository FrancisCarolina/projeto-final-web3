@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Relatório de Produtos Sem Estoque</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>Unidade</th>
                <th>Categoria</th>
                <th>Data que o Estoque Findou</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->nome }}</td>
                <td>{{ $product->unidadeMedida->sigla }}</td>
                <td>{{ $product->categoria->name }}</td>
                <td>{{ $product->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection