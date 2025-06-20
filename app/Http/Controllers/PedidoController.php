<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Listar todos pedidos
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedido', compact('pedidos'));
    }

    // Mostrar formulário para criar pedido
    public function create()
    {
        return view('pedidos.create');
    }

    // Salvar pedido novo
    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'produto' => 'required|string|max:50',
            'total' => 'required|numeric',
        ]);

        Pedido::create($request->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    // Mostrar formulário para editar pedido
    public function edit(Pedido $pedido)
    {
        return view('pedidos.edit', compact('pedido'));
    }

    // Atualizar pedido
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'produto' => 'required|string|max:50',
            'total' => 'required|numeric',
        ]);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    // Deletar pedido
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso!');
    }

    // Mostrar um pedido específico (opcional)
    public function show(Pedido $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }
}
