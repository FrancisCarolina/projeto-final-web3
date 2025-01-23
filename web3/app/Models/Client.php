<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'cpf', 'email', 'address_id'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
