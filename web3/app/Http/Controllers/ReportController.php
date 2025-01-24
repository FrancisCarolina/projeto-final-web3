<?php

namespace App\Http\Controllers;

use App\Models\StockWithdrawal;
use App\Models\Produto;  // Certifique-se de que o modelo "Produto" está importado
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Exibe a página de seleção de relatórios
    public function index()
    {
        $clients = Client::all(); // Obtém todos os clientes
        return view('reports.index', compact('clients'));
    }

    // Gera o relatório com base no tipo selecionado
    public function generate(Request $request)
    {
        // Lógica para gerar o relatório baseado na escolha do usuário
        $reportType = $request->input('report_type');

        // Chama o método correspondente ao tipo de relatório
        switch ($reportType) {
            case 'withdrawals_by_period':
                return $this->generateWithdrawalsByPeriod($request);
            case 'withdrawals_by_client':
                return $this->generateWithdrawalsByClient($request);
            case 'products_without_stock':
                return $this->generateProductsWithoutStock();
            case 'products_with_stock':
                return $this->generateProductsWithStock();
            default:
                return redirect()->route('reports.index')->with('error', 'Tipo de relatório inválido.');
        }
    }

    public function generateWithdrawalsByClient(Request $request)
    {
        // Lógica para gerar retiradas agrupadas por cliente
        $clientId = $request->input('client_id'); // Se necessário, pode filtrar pelo ID do cliente

        // Consulta para buscar retiradas agrupadas por cliente
        $withdrawals = DB::table('stock_withdrawals')
            ->join('withdrawal_products', 'withdrawal_products.stock_withdrawal_id', '=', 'stock_withdrawals.id')
            ->join('produtos', 'produtos.id', '=', 'withdrawal_products.product_id')  // Alterado para "produtos"
            ->join('clients', 'clients.id', '=', 'stock_withdrawals.client_id')
            ->select('clients.name as client_name', 'produtos.nome as product_name', 'withdrawal_products.quantity', 'produtos.unidade_medida_id', 'produtos.categoria_id', 'stock_withdrawals.withdrawal_date', DB::raw('withdrawal_products.quantity * produtos.valor_unitario as total_value')) // Alterado para "produtos" e "valor_unitario"
            ->when($clientId, function ($query, $clientId) {
                return $query->where('clients.id', $clientId);  // Se for passado um client_id, filtra pela retirada desse cliente
            })
            ->get();

        // Retornar o relatório gerado
        return view('reports.result', compact('withdrawals'));
    }

    // Gera retiradas agrupadas por período
    public function generateWithdrawalsByPeriod(Request $request)
    {
        $period = $request->input('period'); // 'daily', 'weekly', 'monthly'
        $startDate = Carbon::parse($request->input('start_date'));

        // Calculando a data final com base no período
        if ($period == 'daily') {
            $endDate = $startDate->copy()->endOfDay(); // Final do dia
        } elseif ($period == 'weekly') {
            $endDate = $startDate->copy()->endOfWeek(); // Final da semana
        } elseif ($period == 'monthly') {
            $endDate = $startDate->copy()->endOfMonth(); // Final do mês
        }

        // Consulta as retiradas no período selecionado
        $withdrawals = DB::table('stock_withdrawals')
            ->join('withdrawal_products', 'withdrawal_products.stock_withdrawal_id', '=', 'stock_withdrawals.id')
            ->join('produtos', 'produtos.id', '=', 'withdrawal_products.product_id')
            ->join('clients', 'clients.id', '=', 'stock_withdrawals.client_id')
            ->select('produtos.nome as product_name', 'withdrawal_products.quantity', 'produtos.unidade_medida_id', 'produtos.categoria_id', 'clients.name as client_name', 'stock_withdrawals.withdrawal_date', DB::raw('withdrawal_products.quantity * produtos.valor_unitario as total_value'))
            ->whereBetween('stock_withdrawals.withdrawal_date', [$startDate, $endDate])
            ->get();

        return view('reports.result', compact('withdrawals'));
    }


    // Gera retiradas agrupadas por cliente
    public function withdrawalsByClient()
    {
        $withdrawals = StockWithdrawal::with('withdrawalProducts.produto.categoria', 'client')  // Alterado para "produto" e "categoria"
            ->get();

        return view('reports.withdrawals_by_client', compact('withdrawals'));
    }

    // Gera relatório de produtos sem estoque
    public function generateProductsWithoutStock()
    {
        $products = Produto::where('estoque', 0)->get();  // Usando "Produto"

        return view('reports.products_out_of_stock', compact('products'));
    }

    public function generateProductsWithStock()
    {
        $products = Produto::all();  // Usando "Produto"

        // Itera sobre cada produto e calcula a quantidade total e a porcentagem de estoque restante
        foreach ($products as $product) {
            // Soma das quantidades vendidas desse produto
            $soldQuantity = DB::table('withdrawal_products')
                ->join('stock_withdrawals', 'stock_withdrawals.id', '=', 'withdrawal_products.stock_withdrawal_id')
                ->where('withdrawal_products.product_id', $product->id)
                ->sum('withdrawal_products.quantity');  // Soma a quantidade de produtos vendidos

            // Calcula a quantidade total (estoque disponível + vendido)
            $totalStock = $product->estoque + $soldQuantity;

            // Calcula a porcentagem de estoque restante
            if ($totalStock > 0) {
                $product->remaining_percentage = round(($product->estoque / $totalStock) * 100, 2);
            } else {
                $product->remaining_percentage = 0;
            }
        }

        return view('reports.products_in_stock', compact('products'));
    }
}
