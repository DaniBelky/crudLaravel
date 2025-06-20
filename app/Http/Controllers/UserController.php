<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Listar usuários
    public function index()
    {
        $usuarios = Usuario::all();
        return view('Index', compact('usuarios'));
    }

    // Criar novo usuário
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'senha' => 'required|string',
        ]);

        Usuario::create($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    // Atualizar usuário
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|string',
            'senha' => 'required|string',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Excluir usuário
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
