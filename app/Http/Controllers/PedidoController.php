<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produtos; // Importando a model Produtos
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Listar todos os pedidos
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedido', compact('pedidos'));
    }

    // Mostrar formulário para criar pedido
    public function create()
    {
        $produtos = Produtos::all(); // Para popular o select no formulário
        return view('pedidos.create', compact('produtos'));
    }

    // Salvar pedido novo
    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'produto' => 'required|integer', // Agora produto é o ID
            'quantidade' => 'required|integer|min:1',
        ]);

        // Buscar o produto e calcular o total
        $produto = Produtos::findOrFail($request->produto);
        $total = $produto->preco * $request->quantidade;

        Pedido::create([
            'cliente' => $request->cliente,
            'produto' => $request->produto,  // Salvando o ID do produto
            'quantidade' => $request->quantidade,
            'total' => $total,
        ]);

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    // Mostrar formulário para editar pedido
    public function edit(Pedido $pedido)
    {
        $produtos = Produtos::all(); // Para popular o select na edição também
        return view('pedidos.edit', compact('pedido', 'produtos'));
    }

    // Atualizar pedido
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'produto' => 'required|integer',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produtos::findOrFail($request->produto);
        $total = $produto->preco * $request->quantidade;

        $pedido->update([
            'cliente' => $request->cliente,
            'produto' => $request->produto,
            'quantidade' => $request->quantidade,
            'total' => $total,
        ]);

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
