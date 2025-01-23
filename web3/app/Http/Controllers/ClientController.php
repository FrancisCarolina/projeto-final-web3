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
    public function show($id)
    {
        $client = Client::with('address')->find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($client);
    }

    /**
     * Atualizar os dados de um cliente.
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|regex:/^[0-9]+$/|max:15',
            'cpf' => 'nullable|regex:/^[0-9]{11}$/|unique:clients,cpf,' . $id,
            'email' => 'nullable|email|unique:clients,email,' . $id,
            'address.cep' => 'nullable|string|max:9',
            'address.street' => 'nullable|string|max:255',
            'address.neighborhood' => 'nullable|string|max:255',
            'address.city' => 'nullable|string|max:255',
            'address.state' => 'nullable|string|max:2',
            'address.number' => 'nullable|string|max:10',
            'address.complement' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Atualizar endereço, se fornecido
            if ($request->has('address')) {
                $client->address->update($request->address);
            }

            // Atualizar cliente
            $client->update($request->only(['name', 'phone', 'cpf', 'email']));

            return response()->json(['message' => 'Cliente atualizado com sucesso!', 'client' => $client]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar cliente', 'error' => $e->getMessage()], 500);
        }
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
