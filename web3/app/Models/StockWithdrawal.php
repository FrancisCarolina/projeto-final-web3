<?php

// app/Models/StockWithdrawal.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockWithdrawal extends Model
{
    protected $fillable = ['client_id', 'withdrawal_date', 'total_value'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function withdrawalProducts()
    {
        return $this->hasMany(WithdrawalProduct::class, 'stock_withdrawal_id');
    }
}
