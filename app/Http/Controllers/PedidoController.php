<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('produto')->get(); 
        $produtos = Produto::all();
        return view('pedido', compact('pedidos', 'produtos'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('pedidos.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        if ($request->quantidade > $produto->quantidade_estoque) {
            return back()->withErrors(['quantidade' => 'Quantidade solicitada maior que o estoque disponível.'])->withInput();
        }

        Pedido::create([
            'nome_cliente' => $request->nome_cliente,
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
        ]);

        $produto->quantidade_estoque -= $request->quantidade;
        $produto->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');
    }

    public function edit(Pedido $pedido)
    {
        $produtos = Produto::all();
        return view('pedidos.edit', compact('pedido', 'produtos'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        $quantidade_anterior = $pedido->quantidade;
        $diferenca = $request->quantidade - $quantidade_anterior;

        if ($diferenca > 0 && $diferenca > $produto->quantidade_estoque) {
            return back()->withErrors(['quantidade' => 'Quantidade solicitada maior que o estoque disponível.'])->withInput();
        }

        $pedido->update([
            'nome_cliente' => $request->nome_cliente,
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
        ]);

        $produto->quantidade_estoque -= $diferenca;
        $produto->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    public function destroy(Pedido $pedido)
    {
        $produto = $pedido->produto;
        $produto->quantidade_estoque += $pedido->quantidade;
        $produto->save();

        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido excluído com sucesso!');
    }

    public function show(Pedido $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }
}
