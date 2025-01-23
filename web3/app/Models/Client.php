<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // Adiciona a importação

class Client extends Model
{
    use HasFactory, SoftDeletes; // Adiciona o SoftDeletes ao modelo

    protected $fillable = ['name', 'phone', 'cpf', 'email', 'address_id'];

    protected $dates = ['deleted_at']; // Especifica que o campo 'deleted_at' é do tipo data

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
