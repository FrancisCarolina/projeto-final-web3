<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Produto;
use App\Models\StockWithdrawal;
use App\Models\WithdrawalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class StockWithdrawalController extends Controller
{
    public function index()
    {
        // Recupera todas as baixas no estoque
        $withdrawals = StockWithdrawal::all();

        // Passa as baixas para a view
        return view('stock_withdrawals.index', compact('withdrawals'));
    }
    public function create()
    {
        $clients = Client::all();
        $produtos = Produto::all();
        return view('stock_withdrawals.create', compact('clients', 'produtos'));
    }

    public function store(Request $request)
    {
        Log::info('Requisição recebida em store', $request->all());

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',  // Alterado de 'produtos' para 'products'
            'products.*.id' => 'required|exists:produtos,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        Log::info('VALIDAÇÃO', ['validated' => $validated]);

        // Verificar a disponibilidade de estoque para todos os produtos
        foreach ($validated['products'] as $productData) {
            $product = Produto::find($productData['id']);
            if ($product->estoque < $productData['quantity']) {
                // Retorna com um erro se algum produto não tiver estoque suficiente
                return back()->withErrors([
                    'products' => "Quantidade insuficiente no estoque para o produto {$product->nome}.",
                ]);
            }
        }

        try {
            DB::transaction(function () use ($validated) {
                // Criar a baixa no estoque
                $withdrawal = StockWithdrawal::create([
                    'client_id' => $validated['client_id'],
                    'withdrawal_date' => now(),
                    'total_value' => 0, // Será atualizado posteriormente
                ]);

                $totalValue = 0;

                foreach ($validated['products'] as $productData) {
                    $product = Produto::find($productData['id']);
                    // Atualiza o estoque do produto
                    $product->estoque -= $productData['quantity'];
                    $product->save();

                    // Calcula o valor total
                    $value = $product->valor_unitario * $productData['quantity'];
                    $totalValue += $value;

                    // Cria o registro de produto associado à baixa no estoque
                    WithdrawalProduct::create([
                        'stock_withdrawal_id' => $withdrawal->id,
                        'product_id' => $product->id,
                        'quantity' => $productData['quantity'],
                        'total_value' => $value,
                    ]);
                }

                // Atualiza o valor total da baixa
                $withdrawal->update(['total_value' => $totalValue]);
            });

            return redirect()->route('stock_withdrawals.index')->with('success', 'Baixa no estoque registrada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao registrar baixa no estoque: ' . $e->getMessage());
            return back()->with('error', 'Erro ao registrar a baixa no estoque: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        $withdrawal = StockWithdrawal::with('client', 'withdrawalProducts.product')->findOrFail($id);

        return view('stock_withdrawals.show', compact('withdrawal'));
    }
}
