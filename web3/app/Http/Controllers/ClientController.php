<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Listar todos os clientes ou filtrar por nome.
     */
    public function index(Request $request)
    {
        $clients = Client::with('address')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create'); // Retorna o formulário de criação
    }

    public function store(Request $request)
    {
        // Validação dos campos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'cpf' => 'required|numeric|unique:clients,cpf',
            'email' => 'required|email|unique:clients,email',
            'address.cep' => 'required|string',
            'address.street' => 'required|string',
            'address.neighborhood' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.number' => 'required|string',
            'address.complement' => 'nullable|string',
        ]);

        // Criação do endereço
        $address = Address::create($validated['address']);

        // Criação do cliente
        Client::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'cpf' => $validated['cpf'],
            'email' => $validated['email'],
            'address_id' => $address->id,
        ]);

        return redirect()->route('clients.index')->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Exibir detalhes de um cliente específico.
     */
    public function show(Client $client)
    {
        // Passa o cliente para a view
        return view('clients.show', compact('client'));
    }

    // Exibe o formulário de edição
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Atualiza os dados do cliente
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'cpf' => 'nullable|string|max:14',
            'email' => 'nullable|email|max:255',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string',
        ]);

        // Atualiza os dados do cliente
        $client->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'cpf' => $request->cpf,
            'email' => $request->email,
        ]);

        // Atualiza o endereço, se fornecido
        $client->address->update([
            'street' => $request->street,
            'number' => $request->number,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        return redirect()->route('clients.show', $client->id)->with('success', 'Cliente atualizado com sucesso.');
    }

    /**
     * Remover um cliente.
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        try {
            $client->delete();

            return response()->json(['message' => 'Cliente removido com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao remover cliente', 'error' => $e->getMessage()], 500);
        }
    }
}
