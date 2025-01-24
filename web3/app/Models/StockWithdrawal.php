<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockWithdrawal extends Model
{
    protected $fillable = ['client_id', 'withdrawal_date', 'total_value'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->hasMany(WithdrawalProduct::class);
    }
}
