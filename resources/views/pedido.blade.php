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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf
        <div class="form-row align-items-end">
            <div class="col-md-4 mb-2">
                <label for="nome_cliente">Nome do Cliente</label>
                <input type="text" name="nome_cliente" id="nome_cliente" class="form-control" placeholder="Nome do Cliente" value="{{ old('nome_cliente') }}" required>
            </div>

            <div class="col-md-4 mb-2">
                <label for="produto_id">Produto</label>
                <select name="produto_id" id="produto_id" class="form-control" required>
                    <option value="" disabled selected>Selecione um produto</option>
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}>
                            {{ $produto->nome }} (Estoque: {{ $produto->quantidade_estoque }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 mb-2">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" placeholder="Quantidade" value="{{ old('quantidade') }}" min="1" required>
            <div class="col">
                <select name="produto" class="form-control" required>
                    <option value="">Selecione um Produto</option>
                    @foreach(App\Models\Produtos::all() as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }} (R$ {{ number_format($produto->preco, 2, ',', '.') }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="number" name="quantidade" class="form-control" placeholder="Quantidade" min="1" required>
            </div>

            <div class="col-md-2 mb-2">
                <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
            </div>
        </div>
    </form>

    <hr>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Total</th> 
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->nome_cliente }}</td>
                    <td>{{ $pedido->produto->nome ?? 'Produto não encontrado' }}</td>
                    <td>{{ $pedido->quantidade }}</td>
                    <td>R$ {{ number_format($pedido->preco_total, 2, ',', '.') }}</td> 
                    <td>{{ $pedido->cliente }}</td>
                    <td>
                        @php
                            $produto = App\Models\Produtos::find($pedido->produto);
                        @endphp
                        {{ $produto ? $produto->nome : 'Produto não encontrado' }}
                    </td>
                    <td>{{ $pedido->quantidade }}</td>
                    <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarModal{{ $pedido->id }}">
                            Editar
                        </button>

                        <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirma exclusão?')">Excluir</button>
                        </form>
                    </td>
                </tr>

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
                                    <div class="form-group">
                                        <label for="nome_cliente_{{ $pedido->id }}">Nome do Cliente</label>
                                        <input type="text" name="nome_cliente" id="nome_cliente_{{ $pedido->id }}" value="{{ old('nome_cliente', $pedido->nome_cliente) }}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="produto_id_{{ $pedido->id }}">Produto</label>
                                        <select name="produto_id" id="produto_id_{{ $pedido->id }}" class="form-control" required>
                                            @foreach ($produtos as $produto)
                                                <option value="{{ $produto->id }}" {{ (old('produto_id', $pedido->produto_id) == $produto->id) ? 'selected' : '' }}>
                                                    {{ $produto->nome }} (Estoque: {{ $produto->quantidade_estoque }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="quantidade_{{ $pedido->id }}">Quantidade</label>
                                        <input type="number" name="quantidade" id="quantidade_{{ $pedido->id }}" value="{{ old('quantidade', $pedido->quantidade) }}" min="1" class="form-control" required>
                                    </div>
                                    <input type="text" name="cliente" value="{{ $pedido->cliente }}" class="form-control mb-2" required>
                                    <select name="produto" class="form-control mb-2" required>
                                        @foreach(App\Models\Produtos::all() as $produtoItem)
                                            <option value="{{ $produtoItem->id }}" {{ $pedido->produto == $produtoItem->id ? 'selected' : '' }}>
                                                {{ $produtoItem->nome }} (R$ {{ number_format($produtoItem->preco, 2, ',', '.') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="quantidade" value="{{ $pedido->quantidade }}" class="form-control mb-2" min="1" required>
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
