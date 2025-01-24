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


        try {
            DB::transaction(function () use ($validated) {
                $withdrawal = StockWithdrawal::create([
                    'client_id' => $validated['client_id'],
                    'withdrawal_date' => now(),
                    'total_value' => 0, // Será atualizado posteriormente
                ]);

                $totalValue = 0;

                foreach ($validated['products'] as $productData) {
                    $product = Produto::find($productData['id']);
                    if ($product->estoque < $productData['quantity']) {
                        throw ValidationException::withMessages([
                            'products' => "Quantidade insuficiente no estoque para o produto {$product->nome}.",
                        ]);
                    }

                    $product->estoque -= $productData['quantity'];
                    $product->save();

                    $value = $product->valor_unitario * $productData['quantity'];
                    $totalValue += $value;

                    WithdrawalProduct::create([
                        'stock_withdrawal_id' => $withdrawal->id,
                        'product_id' => $product->id,
                        'quantity' => $productData['quantity'],
                        'total_value' => $value,
                    ]);
                }

                $withdrawal->update(['total_value' => $totalValue]);
            });

            return redirect()->route('stock_withdrawals.index')->with('success', 'Baixa no estoque registrada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao registrar baixa no estoque: ' . $e->getMessage());
            return back()->with('error', 'Erro ao registrar a baixa no estoque: ' . $e->getMessage());
        }
    }
}
