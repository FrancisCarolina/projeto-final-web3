<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\StockWithdrawalController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ReportController;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('clients', ClientController::class);
Route::resource('categories', CategoryController::class);
Route::resource('unidades', UnidadeController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('stock_withdrawals', StockWithdrawalController::class);

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
Route::get('relatorios/retiradas/por-periodo', [ReportController::class, 'withdrawalsByPeriod']);
Route::get('relatorios/retiradas/por-cliente', [ReportController::class, 'withdrawalsByClient']);
Route::get('relatorios/produtos/sem-estoque', [ReportController::class, 'productsOutOfStock']);
Route::get('relatorios/produtos/com-estoque', [ReportController::class, 'productsInStock']);
