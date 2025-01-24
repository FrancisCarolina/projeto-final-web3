<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Exibir a lista de categorias
    public function index()
    {
        $categories = Category::all(); // Obtém todas as categorias
        return view('categories.index', compact('categories'));
    }

    // Exibir o formulário de criação de categoria
    public function create()
    {
        return view('categories.create');
    }

    // Armazenar uma nova categoria
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        Category::create($request->all()); // Cria a categoria no banco

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    // Exibir os detalhes de uma categoria
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // Exibir o formulário para editar uma categoria
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Atualizar os dados de uma categoria
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $category->update($request->all()); // Atualiza a categoria

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Excluir uma categoria
    public function destroy(Category $category)
    {
        $category->delete(); // Deleta a categoria

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
