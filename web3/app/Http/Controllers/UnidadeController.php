<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index()
    {
        $unidades = Unidade::all();
        return view('unidades.index', compact('unidades'));
    }

    public function create()
    {
        return view('unidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sigla' => 'required|unique:unidades,sigla',
            'descricao' => 'required',
        ]);

        Unidade::create([
            'sigla' => $request->sigla,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('unidades.index')->with('success', 'Unidade criada com sucesso!');
    }
    public function show($id)
    {
        $unidade = Unidade::findOrFail($id);
        return view('unidades.show', compact('unidade'));
    }

    public function edit($id)
    {
        $unidade = Unidade::findOrFail($id);
        return view('unidades.edit', compact('unidade'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sigla' => 'required|unique:unidades,sigla,' . $id,
            'descricao' => 'required',
        ]);

        $unidade = Unidade::findOrFail($id);
        $unidade->update([
            'sigla' => $request->sigla,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('unidades.index')->with('success', 'Unidade atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $unidade = Unidade::findOrFail($id);
        $unidade->delete();

        return redirect()->route('unidades.index')->with('success', 'Unidade excluída com sucesso!');
    }
}
