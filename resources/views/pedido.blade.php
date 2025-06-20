<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Laravel - Pedidos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">CRUD Laravel - Pedidos</a>
    </div>
</nav>

<div class="container mt-4">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulário de Cadastro --}}
    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="col">
                <input type="text" name="cliente" class="form-control" placeholder="Nome do Cliente" required>
            </div>
            <div class="col">
                <input type="text" name="produto" class="form-control" placeholder="Nome do Produto" required>
            </div>
            <div class="col">
                <input type="number" name="total" step="0.01" class="form-control" placeholder="Quatidade de Produtos" required>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </form>

    <hr>

    {{-- Tabela de Pedidos --}}
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente }}</td>
                    <td>{{ $pedido->produto }}</td>
                    <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                    <td>
                        <!-- Botão Editar (abre modal) -->
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarModal{{ $pedido->id }}">
                            Editar
                        </button>

                        <!-- Form de Excluir -->
                        <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirma exclusão?')">Excluir</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editarModal{{ $pedido->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $pedido->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarModalLabel{{ $pedido->id }}">Editar Pedido</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="cliente" value="{{ $pedido->cliente }}" class="form-control mb-2" required>
                                    <input type="text" name="status" value="{{ $pedido->produto }}" class="form-control mb-2" required>
                                    <input type="number" name="total" value="{{ $pedido->total }}" step="0.01" class="form-control mb-2" required>
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
