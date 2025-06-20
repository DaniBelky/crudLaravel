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

    
    <form action="<?php echo e(route('pedidos.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
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
            <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($pedido->id); ?></td>
                    <td><?php echo e($pedido->cliente); ?></td>
                    <td><?php echo e($pedido->produto); ?></td>
                    <td>R$ <?php echo e(number_format($pedido->total, 2, ',', '.')); ?></td>
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
                                    <input type="text" name="cliente" value="<?php echo e($pedido->cliente); ?>" class="form-control mb-2" required>
                                    <input type="text" name="status" value="<?php echo e($pedido->produto); ?>" class="form-control mb-2" required>
                                    <input type="number" name="total" value="<?php echo e($pedido->total); ?>" step="0.01" class="form-control mb-2" required>
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
<?php /**PATH C:\Users\marco\projetoDePHP\projetoPHP\resources\views/pedido.blade.php ENDPATH**/ ?>