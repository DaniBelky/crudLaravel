<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Laravel - Produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">CRUD Laravel - Produtos</a>
    </div>
</nav>

<div class="container mt-4">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulário de Cadastro --}}
    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="col">
                <input type="text" name="nome" class="form-control" placeholder="Nome" required>
            </div>
            <div class="col">
                <input type="text" name="descricao" class="form-control" placeholder="Descrição">
            </div>
            <div class="col">
                <input type="number" name="preco" class="form-control" step="0.01" placeholder="Preço (R$)" required>
            </div>
            <div class="col">
                <input type="text" name="categoria" class="form-control" placeholder="Categoria">
            </div>
            <div class="col">
                <input type="number" name="estoque" class="form-control" placeholder="Estoque" required>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </form>

    <hr>

    {{-- Tabela de Produtos --}}
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->descricao }}</td>
                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td>{{ $produto->categoria }}</td>
                    <td>{{ $produto->estoque }}</td>
                    <td>
                        <!-- Botão Editar (abre modal) -->
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarModal{{ $produto->id }}">
                            Editar
                        </button>

                        <!-- Form de Excluir -->
                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirma exclusão?')">Excluir</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editarModal{{ $produto->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Produto</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="nome" value="{{ $produto->nome }}" class="form-control mb-2" required>
                                    <input type="text" name="descricao" value="{{ $produto->descricao }}" class="form-control mb-2">
                                    <input type="number" name="preco" value="{{ $produto->preco }}" step="0.01" class="form-control mb-2" required>
                                    <input type="text" name="categoria" value="{{ $produto->categoria }}" class="form-control mb-2">
                                    <input type="number" name="estoque" value="{{ $produto->estoque }}" class="form-control mb-2" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            @endforeach
        </tbody>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
