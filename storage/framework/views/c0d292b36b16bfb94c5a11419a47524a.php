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

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('pedidos.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-row align-items-end">
            <div class="col-md-4 mb-2">
                <label for="nome_cliente">Nome do Cliente</label>
                <input type="text" name="nome_cliente" id="nome_cliente" class="form-control" placeholder="Nome do Cliente" value="<?php echo e(old('nome_cliente')); ?>" required>
            </div>

            <div class="col-md-4 mb-2">
                <label for="produto_id">Produto</label>
                <select name="produto_id" id="produto_id" class="form-control" required>
                    <option value="" disabled selected>Selecione um produto</option>
                    <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($produto->id); ?>" <?php echo e(old('produto_id') == $produto->id ? 'selected' : ''); ?>>
                            <?php echo e($produto->nome); ?> (Estoque: <?php echo e($produto->quantidade_estoque); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-2 mb-2">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" placeholder="Quantidade" value="<?php echo e(old('quantidade')); ?>" min="1" required>
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
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($pedido->id); ?></td>
                    <td><?php echo e($pedido->nome_cliente); ?></td>
                    <td><?php echo e($pedido->produto->nome ?? 'Produto não encontrado'); ?></td>
                    <td><?php echo e($pedido->quantidade); ?></td>
                    <td>R$ <?php echo e(number_format($pedido->preco_total, 2, ',', '.')); ?></td> 
                    <td>
                        <!-- Botão Editar (abre modal) -->
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarModal<?php echo e($pedido->id); ?>">
                            Editar
                        </button>

                        <!-- Form de Excluir -->
                        <form action="<?php echo e(route('pedidos.destroy', $pedido->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirma exclusão?')">Excluir</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editarModal<?php echo e($pedido->id); ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel<?php echo e($pedido->id); ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="<?php echo e(route('pedidos.update', $pedido->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarModalLabel<?php echo e($pedido->id); ?>">Editar Pedido</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nome_cliente_<?php echo e($pedido->id); ?>">Nome do Cliente</label>
                                        <input type="text" name="nome_cliente" id="nome_cliente_<?php echo e($pedido->id); ?>" value="<?php echo e(old('nome_cliente', $pedido->nome_cliente)); ?>" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="produto_id_<?php echo e($pedido->id); ?>">Produto</label>
                                        <select name="produto_id" id="produto_id_<?php echo e($pedido->id); ?>" class="form-control" required>
                                            <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($produto->id); ?>" <?php echo e((old('produto_id', $pedido->produto_id) == $produto->id) ? 'selected' : ''); ?>>
                                                    <?php echo e($produto->nome); ?> (Estoque: <?php echo e($produto->quantidade_estoque); ?>)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="quantidade_<?php echo e($pedido->id); ?>">Quantidade</label>
                                        <input type="number" name="quantidade" id="quantidade_<?php echo e($pedido->id); ?>" value="<?php echo e(old('quantidade', $pedido->quantidade)); ?>" min="1" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
<?php /**PATH C:\Users\belch\Downloads\projetoDePHP\projetoPHP\resources\views/pedido.blade.php ENDPATH**/ ?>