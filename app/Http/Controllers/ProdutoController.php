<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Exibir lista de produtos
    public function index()
    {
        $produtos = Produto::all();
        return view('produto', compact('produtos'));
    }

    // Mostrar formulário de criação
    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'quantidade_estoque' => 'required|integer',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'descricao' => 'nullable|string',
        'quantidade_estoque' => 'required|integer',
        'preco' => 'required|numeric',
    ]);

    $produto->update([
        'nome' => $request->nome,
        'descricao' => $request->descricao,
        'quantidade_estoque' => $request->quantidade_estoque,
        'preco' => $request->preco,
    ]);

    return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
}

    // Deletar o produto
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
