<?php

// app/Models/WithdrawalProduct.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawalProduct extends Model
{
    protected $fillable = ['stock_withdrawal_id', 'product_id', 'quantity', 'total_value'];

    public function stockWithdrawal()
    {
        return $this->belongsTo(StockWithdrawal::class, 'stock_withdrawal_id');
    }

    public function product()
    {
        return $this->belongsTo(Produto::class, 'product_id');
    }
}
