@extends('layouts.app')

@section('title', 'Relatórios')

@section('content')
<div class="container mt-5">
    <!-- Cabeçalho da página -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Escolha o Tipo de Relatório</h1>
    </div>

    <!-- Formulário para escolher o tipo de relatório -->
    <form action="{{ route('reports.generate') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="report_type">Tipo de Relatório</label>
            <select name="report_type" id="report_type" class="form-control" required>
                <option value="withdrawals_by_period">Retiradas Agrupadas por Período</option>
                <option value="withdrawals_by_client">Retiradas Agrupadas por Cliente</option>
                <option value="products_without_stock">Produtos sem Estoque</option>
                <option value="products_with_stock">Produtos com Estoque</option>
            </select>
        </div>

        <!-- Campos adicionais para o relatório de "Retiradas Agrupadas por Período" -->
        <div id="period_fields" class="mt-3" style="display: block;">
            <div class="form-group">
                <label for="period">Período:</label>
                <select name="period" id="period" class="form-control">
                    <option value="daily">Diário</option>
                    <option value="weekly">Semanal</option>
                    <option value="monthly">Mensal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Data de Início:</label>
                <input type="date" name="start_date" id="start_date" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Gerar Relatório</button>
    </form>
</div>

<script>
    // Mostrar os campos de período e data se o relatório escolhido for "Retiradas Agrupadas por Período"
    document.getElementById('report_type').addEventListener('change', function() {
        const periodFields = document.getElementById('period_fields');
        if (this.value === 'withdrawals_by_period') {
            periodFields.style.display = 'block';
        } else {
            periodFields.style.display = 'none';
        }
    });
</script>
@endsection