<?php

// app/Models/Produto.php
// app/Models/Produto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;  // Adiciona SoftDeletes

    protected $fillable = [
        'nome',
        'caminho_imagem',
        'categoria_id',
        'unidade_medida_id',
        'estoque',
        'descricao',
        'valor_unitario',
    ];

    // Relacionamento com a categoria, incluindo categorias excluídas
    public function categoria()
    {
        return $this->belongsTo(Category::class)->withTrashed();  // Inclui categorias excluídas
    }

    // Relacionamento com a unidade de medida
    public function unidadeMedida()
    {
        return $this->belongsTo(Unidade::class)->withTrashed();
    }

    // Função para salvar a imagem
    public function salvarImagem($imagem)
    {
        $nomeImagem = time() . '.' . $imagem->extension();
        $imagem->move(public_path('images/produtos'), $nomeImagem);
        $this->caminho_imagem = 'images/produtos/' . $nomeImagem;
        $this->save();
    }
}
