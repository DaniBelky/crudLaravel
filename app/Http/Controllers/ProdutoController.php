<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Exibir lista de produtos
    public function index()
    {
        $produtos = Produtos::all();
        return view('produto', compact('produtos'));
    }

    // Mostrar formulário de criação
    public function create()
    {
        return view('produtos.create');
    }

    // Salvar novo produto
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'categoria' => 'nullable|string',
            'estoque' => 'required|integer',
        ]);

        Produtos::create($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    // Mostrar formulário de edição
    public function edit(Produtos $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    // Atualizar o produto
    public function update(Request $request, Produtos $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'categoria' => 'nullable|string',
            'estoque' => 'required|integer',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Deletar o produto
    public function destroy($id)
    {
        $produto = Produtos::findOrFail($id);
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
