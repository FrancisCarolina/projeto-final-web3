<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  // Importa SoftDeletes

class Unidade extends Model
{
    use HasFactory, SoftDeletes;  // Adiciona SoftDeletes

    protected $fillable = [
        'sigla',
        'descricao',
    ];
}
