<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawalProduct extends Model
{
    protected $fillable = ['stock_withdrawal_id', 'product_id', 'quantity', 'total_value'];

    public function withdrawal()
    {
        return $this->belongsTo(StockWithdrawal::class);
    }

    public function product()
    {
        return $this->belongsTo(Produto::class);
    }
}
