<?php

// app/Http/Controllers/ProdutoController.php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Category;  // Tabela de categorias
use App\Models\Unidade;   // Tabela de unidades
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        // Mudando para 'categories' e 'unidades' para corresponder ao nome correto das tabelas
        $categorias = Category::all();
        $unidadesMedida = Unidade::all();
        return view('produtos.create', compact('categorias', 'unidadesMedida'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categories,id',  // Mudando para 'categories'
            'unidade_medida_id' => 'required|exists:unidades,id', // Mudando para 'unidades'
            'estoque' => 'required|integer',
            'descricao' => 'required|string',
            'valor_unitario' => 'required|numeric',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produto = Produto::create($request->except('imagem'));

        if ($request->hasFile('imagem')) {
            $produto->salvarImagem($request->file('imagem'));
        }

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        // Mudando para 'categories' e 'unidades' para corresponder ao nome correto das tabelas
        $categorias = Category::all();
        $unidadesMedida = Unidade::all();
        return view('produtos.edit', compact('produto', 'categorias', 'unidadesMedida'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categories,id',  // Mudando para 'categories'
            'unidade_medida_id' => 'required|exists:unidades,id', // Mudando para 'unidades'
            'estoque' => 'required|integer',
            'descricao' => 'required|string',
            'valor_unitario' => 'required|numeric',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produto->update($request->except('imagem'));

        if ($request->hasFile('imagem')) {
            $produto->salvarImagem($request->file('imagem'));
        }

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
