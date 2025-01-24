<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnidadeController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('clients', ClientController::class);
Route::resource('categories', CategoryController::class);
Route::resource('unidades', UnidadeController::class);
