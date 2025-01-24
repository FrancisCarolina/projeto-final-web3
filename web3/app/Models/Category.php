<?php

// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;  // Adiciona SoftDeletes

    // Campos que podem ser preenchidos
    protected $fillable = ['name', 'description'];
}
