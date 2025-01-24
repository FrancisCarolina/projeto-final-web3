@extends('layouts.app')

@section('title', 'Registrar Baixa no Estoque')

@section('content')
<div class="container mt-5">
    <!-- Cabeçalho da página -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Registrar Baixa no Estoque</h1>
        <a href="{{ route('stock_withdrawals.index') }}" class="btn btn-secondary">Voltar para a lista</a>
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

    <!-- Formulário de baixa -->
    <form action="{{ route('stock_withdrawals.store') }}" method="POST">
        @csrf
        <h5 class="text-primary">Informações de Baixa</h5>

        <div class="mb-3">
            <label for="client_id" class="form-label">Cliente</label>
            <select name="client_id" id="client_id" class="form-select" required>
                @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="products-container">
            <h3>Produtos</h3>
            <div class="product-item mb-3" id="product-0">
                <label for="product_id" class="form-label">Produto</label>
                <select name="products[0][id]" class="form-select" required>
                    @foreach ($produtos as $product)
                    <option value="{{ $product->id }}">{{ $product->nome }}</option>
                    @endforeach
                </select>

                <label for="quantity" class="form-label">Quantidade</label>
                <input type="number" name="products[0][quantity]" class="form-control" required>
            </div>
        </div>

        <button type="button" id="add-product" class="btn btn-secondary">Adicionar Produto</button>
        <button type="submit" class="btn btn-primary">Registrar Baixa</button>
    </form>
</div>

<script>
    let productIndex = 1; // Aumenta o índice para o próximo produto
    document.getElementById('add-product').addEventListener('click', function() {
        let container = document.getElementById('products-container');
        let newProductHTML = `
            <div class="product-item mb-3" id="product-${productIndex}">
                <label for="product_id" class="form-label">Produto</label>
                <select name="products[${productIndex}][id]" class="form-select" required>
                    @foreach ($produtos as $product)
                        <option value="{{ $product->id }}">{{ $product->nome }}</option>
                    @endforeach
                </select>

                <label for="quantity" class="form-label">Quantidade</label>
                <input type="number" name="products[${productIndex}][quantity]" class="form-control" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newProductHTML);
        productIndex++; // Incrementa o índice para o próximo produto
    });
</script>

@endsection